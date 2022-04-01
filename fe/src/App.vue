<template>
  <v-app>
    <v-main class="mt-12">
      <v-container>
        <app-card
          color="success"
          :title="`Satellite Map - ${computedShow.title}`"
          class="px-5 py-3"
        >
          <app-maps :data="computedShow"></app-maps>
        </app-card>
        <app-tabs
          :data="computedData"
          @edit="openDialogUpdate"
          @input="inserData"
          @show="showMap"
          @destroy="openDialogDelete"
        ></app-tabs>
      </v-container>
    </v-main>
    <app-update :dialog="dialogUpdate" @input="updateData"></app-update>
    <app-delete :dialog="dialogDelete" @delete="deleteData"></app-delete>
  </v-app>
</template>

<script>
// import HelloWorld from "./components/HelloWorld";
import card from "./components/Card.vue";
import tabs from "./components/Tabs.vue";
import maps from "./components/map/_map.vue";
import dialogUpdate from "./components/dialog/DialogInput.vue";
import openDialogDelete from "./components/dialog/DialogNotice.vue";

export default {
  name: "App",

  components: {
    "app-tabs": tabs,
    "app-maps": maps,
    "app-card": card,
    "app-update": dialogUpdate,
    "app-delete": openDialogDelete,
  },

  data: () => ({
    dialogUpdate: {
      open: false,
      data: {},
    },
    dialogDelete: {
      open: false,
      data: {},
    },
  }),

  computed: {
    computedData() {
      return this.$store.state.map.data;
    },
    computedShow() {
      return this.$store.state.map.show;
    },
  },
  mounted() {
    this.getData();
    this.showData();
  },
  methods: {
    getData() {
      this.$store.dispatch("map/getData");
    },
    showData(id) {
      this.$store.dispatch("map/showData", {
        id: id,
      });
    },
    inserData(item) {
      this.$store
        .dispatch("map/inserData", {
          title: item.title,
          address: item.address,
          description: item.description,
          mark_as: item.mark_as,
          ordinat: item.ordinat,
        })
        .then((res) => {
          if (res.data.meta.status) {
            item = null;
            alert("Data has been saved");
            localStorage.setItem("id", res.data.data.id);
            // this.tab = "tab-2";
            localStorage.setItem("tabs", "tab-2");
            this.showData(res.data.data.id);
          }
        });
    },
    updateData(item) {
      this.$store
        .dispatch("map/updateData", {
          id: item.id,
          title: item.title,
          address: item.address,
          description: item.description,
          mark_as: item.mark_as,
          ordinat: item.ordinat,
        })
        .then((res) => {
          if (res.data.meta.status) {
            alert("Data has been updated");
            this.dialogUpdate.open = false;
          }
        });
    },
    deleteData(item) {
      this.$store
        .dispatch("map/deleteData", {
          id: item.id,
        })
        .then((res) => {
          if (res.data.meta.status) {
            alert("Data has been deleted with title " + item.title);
            this.dialogDelete.open = false;
            this.getShow();
          }
        });
    },
    showMap(item) {
      this.showData(item.id);
      alert(`show map with title ${item.title}`);
    },
    openDialogUpdate(item) {
      this.dialogUpdate.open = true;
      this.dialogUpdate.data = item;
    },
    openDialogDelete(item) {
      this.dialogDelete.open = true;
      this.dialogDelete.data = item;
    },
  },
};
</script>
