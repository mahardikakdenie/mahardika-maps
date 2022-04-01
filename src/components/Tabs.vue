<template>
  <v-container>
    <v-tabs color="success" v-model="overwriteTab" centered icons-and-text>
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

    <v-tabs-items v-model="overwriteTab">
      <v-tab-item :value="'tab-1'">
        <app-input @add="addData" />
      </v-tab-item>
      <v-tab-item :value="'tab-2'">
        <app-list :data="data" class="mt-12" />
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
    tab: {
      type: String,
      default: "tab-1",
    },
  },

  data: () => ({
    // tab: null,
    text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
  }),
  watch: {
    // tab() {},
  },
  computed: {
    overwriteTab: {
      get() {
        return this.tab;
      },
      set(value) {
        this.tab = value;
      },
    },
  },
  methods: {
    addData(item) {
      this.$emit("input", item);
    },
  },
};
</script>

<style></style>
