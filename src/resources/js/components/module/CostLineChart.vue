<script>
import { Line } from "vue-chartjs";
export default {
  extends: Line,
  props: {
    chartData: {
      type: Object,
    },
  },
  methods: {
    renderLineChart() {
      this.renderChart(this.chartData, {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
                min: -70000,
                max: 70000,
                stepSize: 2000,
              },
            },
          ],
        },
      });
    },
  },
};
</script>
