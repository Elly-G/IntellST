<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="6">
        <div class="chart">
          <h1 style="text-align: center;">
            {{ $t("home.graph1") }} {{ $t("home.and") }} {{ $t("home.graph2") }}
          </h1>

          <bar-chart />
        </div>
      </v-col>

      <v-col cols="12" md="6">
        <div class="chart">
          <h1 style="text-align: center;">
            {{ $t("home.graph1") }} {{ $t("home.and") }} {{ $t("home.graph3") }}
          </h1>

          <line-chart />
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import BarChart from "../components/BarChart";
import LineChart from "../components/LineChart";

export default {
  components: {
    "bar-chart": BarChart,
    "line-chart": LineChart,
  },
};
</script>
