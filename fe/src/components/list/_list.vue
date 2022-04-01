<template>
  <app-card icon="mdi-clipboard-list-outline">
    <template #after-heading>
      <h2 class="success--text">List Map</h2>
    </template>
    <v-container>
      <v-row>
        <v-col cols="12" md="4">
          <v-text-field
            v-model="search"
            class=""
            append-icon="mdi-magnify"
            :label="`Search`"
            :placeholder="`Search`"
          />
        </v-col>
        <v-col cols="12">
          <v-data-table :search="search" :items="data" :headers="headers">
            <template #[`item.address`]="{ item }">
              {{ item.address ? item.address : "-" }}
            </template>
            <template #[`item.ordinat`]="{ item }">
              {{ item.ordinat ? item.ordinat : "-" }}
            </template>
            <template #[`item.action`]="{ item }">
              <v-row>
                <v-col cols="12" md="4">
                  <v-btn icon color="info" small @click="edit(item)">
                    <v-icon>mdi-pencil</v-icon>
                  </v-btn>
                </v-col>
                <v-col @click="destroy(item)" cols="12" md="4">
                  <v-btn icon small color="error">
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </v-col>
                <v-col cols="12" md="4">
                  <v-btn @click="show(item)" icon small color="success">
                    <v-icon>mdi-eye</v-icon>
                  </v-btn>
                </v-col>
              </v-row>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
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
    search: "",
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
        text: "Ordinat",
        value: "ordinat",
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
  methods: {
    edit(item) {
      this.$emit("edit", item);
    },
    destroy(item) {
      this.$emit("destroy", item);
    },
    show(item) {
      this.$emit("show", item);
    },
  },
};
</script>

<style></style>
