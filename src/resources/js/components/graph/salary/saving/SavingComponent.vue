<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>総支給給与と手取り額の推移</h2>
      <salary-line-chart :chartData="lineChartData" :height="295" ref="chart"></salary-line-chart>
    </div>
  </div>
</template>

<script>
import SalaryLineChart from "../../../module/SalaryLineChart";
export default {
  props: {
    year: Number,
    month: Number,
  },
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
    axios.get("/api/salary/all/").then((res) => {
      this.salaryData = res.data;
      this.lineChartData = Object.assign({}, this.lineChartData, {
        labels: this.salaryData.map((item) => item.yearMonth),
        datasets: [
          {
            label: ["総支給額"],
            fill: false,
            borderColor: "#FF6928",
            data: this.salaryData.map((item) => item.totalSalary),
            hoverRadius: 10,
          },
          {
            label: ["手取額"],
            fill: false,
            borderColor: "#4DF9B9",
            data: this.salaryData.map((item) => item.netIncome),
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
labels: this.dailyCostsAmount.map((item) => item.day),
