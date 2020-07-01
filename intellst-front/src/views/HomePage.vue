<template>
  <v-container class="fill-height home" fluid>
    <v-row>
      <v-col cols="12" sm="6">
        <div class="chart mb-2">
          <h1 style="text-align: center;">{{ $t("home.graph1") }}</h1>
          <BarChart />
        </div>
      </v-col>

      <v-col cols="12" sm="6">
        <div class="chart mb-2">
          <h1 style="text-align: center;">{{ $t("home.graph2") }}</h1>
          <LineChart />
        </div>
      </v-col>

      <v-col cols="12" sm="6">
        <div class="chart mb-2">
          <h1 style="text-align: center;">
            {{ $t("home.graph3") }}
          </h1>
          <BarChart />
        </div>
      </v-col>

      <v-col cols="12" sm="6">
        <div class="chart mb-2">
          <h1 style="text-align: center;">{{ $t("home.graph4") }}</h1>
          <LineChart />
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
    BarChart,
    LineChart,
  },
};
</script>
