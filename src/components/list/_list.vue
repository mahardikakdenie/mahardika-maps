<template>
  <app-card icon="mdi-clipboard-list-outline">
    <template #after-heading>
      <h2 class="success--text">List Map</h2>
    </template>
    <v-container>
      <v-data-table :items="data" :headers="headers">
        <template #[`item.action`]="{ item }">
          <v-row>
            <v-col cols="12" md="4">
              <v-btn icon color="info" small @click="edit(item)">
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
            </v-col>
            <v-col cols="12" md="4">
              <v-btn icon small color="error">
                <v-icon>mdi-delete</v-icon>
              </v-btn>
            </v-col>
            <v-col cols="12" md="4">
              <v-btn icon small color="success">
                <v-icon>mdi-eye</v-icon>
              </v-btn>
            </v-col>
          </v-row>
        </template>
      </v-data-table>
    </v-container>
  </app-card>
</template>

<script>
import card from "../Card.vue";
export default {
  props: {
    data: {
      type: Array,
      default: null,
    },
  },
  components: {
    "app-card": card,
  },
  data: () => ({
    headers: [
      {
        text: "#",
        value: "id",
      },
      {
        text: "Title",
        value: "title",
      },
      {
        text: "Address",
        value: "address",
      },
      {
        text: "Descripton",
        value: "description",
      },
      {
        text: "Mark As",
        value: "mark_as",
      },
      {
        text: "Action",
        value: "action",
      },
    ],
  }),
};
</script>

<style></style>
