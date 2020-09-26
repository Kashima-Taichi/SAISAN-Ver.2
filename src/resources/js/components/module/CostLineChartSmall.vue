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
                min: -20000,
                max: 20000,
                stepSize: 1000,
              },
            },
          ],
        },
      });
    },
  },
};
</script>
