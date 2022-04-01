<template>
  <v-container>
    <v-dialog v-model="dialog.open" width="70%">
      <v-card>
        <v-system-bar
          :color="$vuetify.theme.dark ? '#141C31' : '#F0F8FF'"
          window
        >
          <v-toolbar-title
            :class="$vuetify.theme.dark ? 'white--text' : ' black--text'"
            class="font-size-ather-roboto-mono"
          >
            <v-icon :color="$vuetify.theme.dark ? 'white' : 'black'">
              mdi-delete
            </v-icon>
            Delete Data
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false"> mdi-close </v-icon>
        </v-system-bar>
        <v-container>
          <v-row>
            <v-col cols="12">
              <span>
                Are you sure want to delete this data with title "{{
                  dialog.data.title
                }}" ?
              </span>
            </v-col>
            <v-col cols="12" class="d-flex justify-end">
              <v-btn @click="dialog.open = false" color="success" class="mr-2"
                >Cancel</v-btn
              >
              <v-btn color="error" @click="submit">Delete</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  props: {
    dialog: {
      type: Object,
      default: null,
    },
  },
  methods: {
    submit() {
      this.$emit("delete", this.dialog.data);
    },
  },
};
</script>

<style></style>
