<script>
import { Bar } from "../plugins/charts";

export default {
  extends: Bar,
  mounted() {
    this.renderChart(
      {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday ",
          "Sunday",
        ],
        datasets: [
          {
            label: "Data",
            backgroundColor: "#d01919",
            data: [40, 25, 12, 39, 10, 20, 31],
          },
        ],
      },
      { responsive: true, maintainAspectRatio: false }
    );
  },
};
</script>
