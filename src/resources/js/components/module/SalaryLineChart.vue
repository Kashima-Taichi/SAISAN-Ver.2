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
                min: 0,
                max: 400000,
                stepSize: 40000,
              },
            },
          ],
        },
      });
    },
  },
};
</script>
