<template>
  <v-flex xs12>
    <v-container class="justify-content-center">
      <v-toolbar dense color="gradient" height="80">
        <v-toolbar-title>
          <h1>{{ $t("cases.title") }}</h1>
        </v-toolbar-title>
      </v-toolbar>
      <v-expansion-panels multiple focusable>
        <v-expansion-panel v-for="(item, i) in 5" :key="i">
          <v-expansion-panel-header>
            {{ formatDay(i) }}
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <PersonPhoto :current-week-date="formatDay(i)" />
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>

      <v-expansion-panels focusable class="mt-5">
        <v-expansion-panel>
          <v-expansion-panel-header>{{
            $t("cases.older")
          }}</v-expansion-panel-header>
          <v-expansion-panel-content class="row mt-2">
            <v-expansion-panels multiple focusable>
              <v-expansion-panel v-for="(item, i) in 5" :key="i">
                <v-expansion-panel-header>
                  {{ formatDay(i, 5) }}
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                  <PersonPhoto :current-week-date="formatDay(i, 5)" />
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-container>
  </v-flex>
</template>

<script>
import PersonPhoto from "../components/PersonPhoto";
import moment from "moment";
import { mapActions } from "vuex";

export default {
  name: "ConsultCases",
  components: {
    PersonPhoto,
  },
  mounted() {
    this.identifiedCases();
  },
  methods: {
    ...mapActions("login", ["identifiedCases"]),
    formatDay(index, days = 0) {
      return moment()
        .subtract(index + days, "days")
        .format("MM/DD/YYYY");
    },
  },
};
</script>
