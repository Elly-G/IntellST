<script>
import { Bar } from "vue-chartjs";
import { mapState, mapActions } from "vuex";

export default {
  extends: Bar,
  data() {
    return {
      chartdata: {
        labels: [],
        datasets: [
          {
            label: this.$t("home.graph1"),
            backgroundColor: "#d01919",
            data: [],
          },
          {
            label: this.$t("home.graph2"),
            backgroundColor: "#515052",
            data: [],
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  mounted() {
    const app = this;
    this.graphEntries().then(() => {
      this.chartdata.labels = Object.keys(this.graphData).map((key) => key);
      this.chartdata.datasets[0].data = Object.keys(this.graphData).map(
        (key) => this.graphData[key]
      );
      this.$nextTick().then(function () {
        app.renderChart(app.chartdata, app.options);
      });
    });
    this.graphValid().then(() => {
      this.chartdata.labels = Object.keys(this.graphData).map((key) => key);
      this.chartdata.datasets[1].data = Object.keys(this.graphData).map(
        (key) => this.graphData[key]
      );
      this.$nextTick().then(function () {
        app.renderChart(app.chartdata, app.options);
      });
    });
  },
  computed: {
    ...mapState("login", ["userToken", "graphData"]),
  },
  methods: {
    ...mapActions("login", ["graphEntries"]),
    ...mapActions("login", ["graphValid"]),
  },
};
</script>
