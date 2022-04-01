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
              mdi-account-plus
            </v-icon>
            Update Data
          </v-toolbar-title>

          <v-spacer />

          <v-icon @click="dialog.open = false"> mdi-close </v-icon>
        </v-system-bar>
        <v-container>
          <v-row>
            <v-col cols="12">
              <v-form ref="observer" v-model="is_validate">
                <v-text-field
                  v-model="dialog.data.title"
                  :rules="[validateNotNull]"
                  label="Title"
                  outlined
                  placeholder="Title"
                ></v-text-field>
                <div class="mb-2 d-flex justify-end">
                  <v-btn @click="showKoordinar(dialog.data)" color="success">
                    Use
                    {{
                      dialog.data.is_address ? "Koordinat" : "Address"
                    }}</v-btn
                  >
                </div>
                <v-text-field
                  v-model="dialog.data.address"
                  v-if="dialog.data.is_address"
                  :rules="[validateNotNull]"
                  outlined
                  placeholder="Address"
                  label="Address"
                  append-icon="mdi-map-marker"
                >
                </v-text-field>
                <v-text-field
                  v-model="dialog.data.ordinat"
                  v-if="!dialog.data.is_address"
                  :rules="[validateNotNull]"
                  outlined
                  placeholder="Koordinat"
                  label="Koordinat"
                  append-icon="mdi-map-marker"
                >
                </v-text-field>
                <v-select
                  v-model="dialog.data.mark_as"
                  :items="items"
                  :rules="[validateNotNull]"
                  label="Mark As"
                  placeholder="Mark As"
                  outlined
                ></v-select>
                <v-textarea
                  v-model="dialog.data.description"
                  outlined
                  :rules="[validateNotNull]"
                  label="Description"
                  placeholder="Description"
                ></v-textarea>
              </v-form>
            </v-col>
            <v-col cols="12" class="d-flex justify-end">
              <v-btn color="error" @click="dialog.open = false" class="mr-2"
                >Cancel</v-btn
              >
              <v-btn @click="submit" color="success">Update</v-btn>
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
  data: () => ({
    is_validate: true,
    is_address: false,
    items: ["Office", "Home", "Hotel", "Restaurant", "School"],
    validateNotNull: (v) => v !== null && v !== "",
  }),
  methods: {
    showKoordinar(item) {
      item.is_address = !item.is_address;
    },
    submit() {
      this.$emit("input", {
        item: this.dialog.data,
        is_address: this.is_address,
      });
    },
  },
};
</script>

<style></style>
