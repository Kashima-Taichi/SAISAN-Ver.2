<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>経費計上合計金額推移(全期間)</h2>
      <cost-line-chart :chartData="lineChartData" :height="240" ref="chart"></cost-line-chart>
    </div>
  </div>
</template>

<script>
import CostLineChart from "../../../module/CostLineChart";

export default {
  data() {
    return {
      loading: true,
      costAmounts: [],
      lineChartData: {},
    };
  },
  components: {
    CostLineChart,
  },
  mounted() {
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios.get("/api/cost/amounts/all/").then((res) => {
      this.costAmounts = res.data;
      this.lineChartData = Object.assign({}, this.lineChartData, {
        labels: this.costAmounts.map((item) => item.year + "-" + item.month),
        datasets: [
          {
            label: ["経費計上合計金額推移(全期間)"],
            fill: false,
            borderColor: "#136FFF",
            data: this.costAmounts.map((item) => item.sum),
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
