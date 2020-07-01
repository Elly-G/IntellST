<template>
  <v-app>
    <router-view />
  </v-app>
</template>

<script>
export default {
  name: "App",
  components: {},
  created() {
    this.$vuetify.theme.dark = true;
  },
};
</script>
