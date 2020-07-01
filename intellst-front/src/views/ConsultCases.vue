<template>
  <v-flex xs12>
    <v-container class="justify-content-center">
      <v-toolbar dense color="gradient" height="80">
        <v-toolbar-content>
          <text-field>
            <h1>{{ $t("cases.title") }}</h1>
          </text-field>
        </v-toolbar-content>
      </v-toolbar>
      <v-expansion-panels multiple focusable>
        <v-expansion-panel v-for="(item, i) in 5" :key="i">
          <v-expansion-panel-header>
            {{ new Date() | moment("subtract", `${i} days`, "MM/DD/YYYY") }}
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <PersonPhoto />
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
                  {{
                    new Date()
                      | moment("subtract", `${i + 5} days`, "MM/DD/YYYY")
                  }}
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                  <PersonPhoto />
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

export default {
  components: {
    PersonPhoto,
  },
};
</script>
