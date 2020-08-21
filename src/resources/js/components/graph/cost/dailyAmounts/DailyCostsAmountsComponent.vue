<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>{{ year }}年 {{ month }}月, {{ month - 1 }}月 経費計上合計金額推移</h2>
      <line-chart :chartData="lineChartData" :height="295" ref="chart"></line-chart>
    </div>
  </div>
</template>

<script>
import LineChart from "../../../module/LineChart";
export default {
  props: {
    year: Number,
    month: Number,
  },
  data() {
    return {
      loading: true,
      dailyCostsAmounts: [],
      lineChartData: {},
    };
  },
  components: {
    LineChart,
  },
  mounted() {
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios
      .get("/api/cost/amounts/daily/" + this.year + "/" + this.month + "/")
      .then((res) => {
        this.dailyCostsAmounts = res.data;
        //console.log(this.dailyCostsAmounts);
        this.lineChartData = Object.assign({}, this.lineChartData, {
          labels: this.dailyCostsAmounts.selected.map((item) => item.day),
          datasets: [
            {
              label: [this.month + "月"],
              fill: false,
              borderColor: "#FF6928",
              data: this.dailyCostsAmounts.selected.map(
                (item) => item.dayAmount
              ),
              hoverRadius: 10,
            },
            {
              label: [this.month - 1 + "月"],
              fill: false,
              borderColor: "#4DF9B9",
              data: this.dailyCostsAmounts.minus.map((item) => item.dayAmount),
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
