<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>利益額推移</h2>
      <salary-line-chart :chartData="lineChartData" :height="295" ref="chart"></salary-line-chart>
    </div>
  </div>
</template>

<script>
import SalaryLineChart from "../../../module/SalaryLineChart";
export default {
  data() {
    return {
      loading: true,
      salaryData: [],
      lineChartData: {},
    };
  },
  components: {
    SalaryLineChart,
  },
  mounted() {
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios.get("/api/salary/profit/").then((res) => {
      this.salaryData = res.data;
      this.lineChartData = Object.assign({}, this.lineChartData, {
        labels: Object.keys(this.salaryData),
        datasets: [
          {
            label: ["純利益"],
            fill: false,
            borderColor: "#FF6928",
            data: Object.values(this.salaryData),
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
