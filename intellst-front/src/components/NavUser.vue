<template>
  <v-menu bottom right transition="scale-transition" origin="top left">
    <template v-slot:activator="{ on }">
      <v-chip pill v-on="on" color="transparent" class="text-capitalize">
        <v-avatar left>
          <v-btn icon>
            <v-icon>mdi-account</v-icon>
          </v-btn>
        </v-avatar>
        {{ userData.firstname }}
      </v-chip>
    </template>
    <v-card>
      <v-list>
        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title class="text-capitalize">
              {{ userData.firstname }} {{ userData.lastname }}
            </v-list-item-title>
            <v-list-item-subtitle>{{ userData.email }}</v-list-item-subtitle>
          </v-list-item-content>
          <v-list-item-action>
            <v-btn icon>
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-list>
    </v-card>
  </v-menu>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  mounted() {
    this.getUserInfo();
  },
  computed: {
    ...mapState("login", ["userToken", "userData"]),
  },
  methods: {
    ...mapActions("login", ["getUserInfo"]),
  },
};
</script>
