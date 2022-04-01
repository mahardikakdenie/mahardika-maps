<template>
  <v-container>
    <v-tabs color="success" v-model="tab" centered icons-and-text>
      <v-tabs-slider></v-tabs-slider>
      <v-tab href="#tab-1">
        Input
        <v-icon>mdi-map-marker</v-icon>
      </v-tab>

      <v-tab href="#tab-2">
        List
        <v-icon>mdi-heart</v-icon>
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item :value="'tab-1'">
        <app-input @add="addData" />
      </v-tab-item>
      <v-tab-item :value="'tab-2'">
        <app-list
          :data="data"
          @edit="editData"
          @show="showData"
          class="mt-12"
        />
      </v-tab-item>
    </v-tabs-items>
  </v-container>
</template>

<script>
import input from "./input/_input.vue";
import list from "./list/_list.vue";
export default {
  components: {
    "app-input": input,
    "app-list": list,
  },
  props: {
    data: {
      type: Array,
      default: null,
    },
  },

  data: () => ({
    tab: null || localStorage.getItem("tabs"),
    text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
  }),
  watch: {
    // tab() {},
  },
  computed: {},
  methods: {
    addData(item) {
      this.$emit("input", item);
    },
    editData(item) {
      this.$emit("edit", item);
    },
    destroyData(item) {
      this.$emit("destroy", item);
    },
    showData(item) {
      this.$emit("show", item);
    },
  },
};
</script>

<style></style>
