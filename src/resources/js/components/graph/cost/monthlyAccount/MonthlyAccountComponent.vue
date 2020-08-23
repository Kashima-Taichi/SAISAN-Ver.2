<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>{{ account }} 経費計上金額推移</h2>
      <cost-line-chart :chartData="lineChartData" :height="295" ref="chart"></cost-line-chart>
    </div>
  </div>
</template>

<script>
import CostLineChart from "../../../module/CostLineChart";
export default {
  props: {
    account: String,
  },
  data() {
    return {
      loading: true,
      accountCostAmount: [],
      lineChartData: {},
    };
  },
  components: {
    CostLineChart,
  },
  mounted() {
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios.get("/api/cost/monthly/" + this.account + "/").then((res) => {
      this.accountCostAmount = res.data;
      this.lineChartData = Object.assign({}, this.lineChartData, {
        labels: this.accountCostAmount.map((item) => item.timeStamp),
        datasets: [
          {
            label: [this.account],
            fill: false,
            borderColor: "#FF6928",
            data: this.accountCostAmount.map((item) => item.accountAmount),
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
