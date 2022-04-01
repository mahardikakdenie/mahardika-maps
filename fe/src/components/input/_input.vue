<template>
  <v-container>
    <v-row class="d-flex justify-center">
      <v-col cols="12" md="6">
        <v-form ref="observer" v-model="is_validate">
          <v-text-field
            v-model="form.title"
            :rules="[validateNotNull]"
            label="Title"
            outlined
            placeholder="Title"
          ></v-text-field>
          <div class="mb-2 d-flex justify-end">
            <v-btn @click="showKoordinar" color="success">
              Use {{ is_address ? "Koordinat" : "Address" }}</v-btn
            >
          </div>
          <v-text-field
            v-model="form.address"
            v-if="is_address"
            :rules="[validateNotNull]"
            outlined
            placeholder="Address"
            label="Address"
            append-icon="mdi-map-marker"
          >
          </v-text-field>
          <v-text-field
            v-model="form.ordinat"
            v-if="!is_address"
            :rules="[validateNotNull]"
            outlined
            placeholder="Koordinat"
            label="Koordinat"
            append-icon="mdi-map-marker"
          >
          </v-text-field>
          <v-select
            v-model="form.mark_as"
            :items="items"
            :rules="[validateNotNull]"
            label="Mark As"
            placeholder="Mark As"
            outlined
          ></v-select>
          <v-textarea
            v-model="form.description"
            outlined
            :rules="[validateNotNull]"
            label="Description"
            placeholder="Description"
          ></v-textarea>
        </v-form>
      </v-col>
      <v-col class="d-flex justify-center" cols="12">
        <v-btn @click="clear" color="error" class="mr-2"> Reset </v-btn>
        <v-btn @click="submit" :disabled="!is_validate" color="success">
          Add List
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    form: {
      title: "",
      ordinat: "",
      address: "",
      mark_as: "",
      description: "",
    },
    is_validate: true,
    is_address: false,
    items: ["Office", "Home", "Hotel", "Restaurant", "School"],
    validateNotNull: (v) => v !== null && v !== "",
  }),

  computed: {},
  methods: {
    submit() {
      this.$refs.observer.validate();
      this.$emit("add", { item: this.form, is_address: this.is_address });
      this.$refs.observer.reset();
    },
    showKoordinar() {
      this.is_address = !this.is_address;
    },
    clear() {
      this.form.title = "";
      this.form.ordinat = "";
      this.form.address = "";
      this.form.mark_as = null;
      this.form.description = null;
      alert("Form has been reset");
      this.$refs.observer.reset();
    },
  },
};
</script>
<style></style>
