<template>
  <v-snackbar
    :value="showSnack"
    @input="hideSnack"
    :color="snackType"
    top
    right
  >
    {{ snackMessage }}
    <template v-slot:action="{ attrs }">
      <v-icon text v-bind="attrs" @click.native="hideSnack">mdi-close</v-icon>
    </template>
  </v-snackbar>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  computed: {
    ...mapState("snackbar", ["showSnack", "snackMessage", "snackType"]),
  },
  methods: {
    ...mapActions("snackbar", ["hideSnack"]),
  },
};
</script>
