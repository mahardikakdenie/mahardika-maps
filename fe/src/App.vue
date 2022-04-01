<template>
  <v-app>
    <v-main class="mt-12">
      <v-container>
        <app-card color="success" title="Satellite Map" class="px-5 py-3">
          <app-maps :data="computedShow"></app-maps>
        </app-card>
        <app-tabs
          :tab="overwriteTab"
          :data="computedData"
          @input="inserData"
        ></app-tabs>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
// import HelloWorld from "./components/HelloWorld";
import card from "./components/Card.vue";
import tabs from "./components/Tabs.vue";
import maps from "./components/map/_map.vue";

export default {
  name: "App",

  components: {
    "app-tabs": tabs,
    "app-maps": maps,
    "app-card": card,
  },

  data: () => ({
    tab: "tab-1",
  }),

  computed: {
    computedData() {
      return this.$store.state.map.data;
    },
    computedShow() {
      return this.$store.state.map.show;
    },
    overwriteTab: {
      get() {
        return this.tab;
      },
      set(value) {
        this.tab = value;
      },
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
            alert("Data has been saved");
            localStorage.setItem("id", res.data.data.id);
            this.tab = "tab-2";
            this.showData(res.data.data.id);
          }
        });
    },
  },
};
</script>
