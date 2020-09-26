<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>過去200日間の経費計上金額推移</h2>
      <cost-line-chart :chartData="lineChartData" ref="chart"></cost-line-chart>
    </div>
  </div>
</template>

<script>
import CostLineChart from "../../../module/CostLineChartLarge";
export default {
  data() {
    return {
      loading: true,
      dailyCostsAmount: [],
      lineChartData: {},
    };
  },
  components: {
    CostLineChart,
  },
  mounted() {
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios.get("/api/cost/long/").then((res) => {
      this.dailyCostsAmount = res.data;
      this.lineChartData = Object.assign({}, this.lineChartData, {
        labels: this.dailyCostsAmount.map((item) => item.datetime),
        datasets: [
          {
            label: ["経費計上金額推移"],
            fill: false,
            borderColor: "#136FFF",
            data: this.dailyCostsAmount.map((item) => item.sum),
            hoverRadius: 10,
          },
        ],
      });
      this.$nextTick(() => {
        this.$refs.chart.renderLineChart();
      });
      this.loading = false;
    });
  },
};
</script>
