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
                min: -100000,
                max: 100000,
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
