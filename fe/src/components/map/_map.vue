<template>
  <v-container>
    <v-card-text class="px-0 pb-0">
      <v-sheet>
        <iframe
          :src="data.url"
          width="100%"
          height="450"
          frameborder="0"
          style="border: 0"
          allowfullscreen
        />
      </v-sheet>
    </v-card-text>
  </v-container>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      default: () => ({}),
    },
  },
};
</script>

<style></style>
