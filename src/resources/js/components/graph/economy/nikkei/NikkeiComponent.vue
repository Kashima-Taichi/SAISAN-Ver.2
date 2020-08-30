<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>日経平均推移</h2>
      <nikkei-line-chart :chartData="lineChartData" :height="295" ref="chart" id="chart"></nikkei-line-chart>
    </div>
  </div>
</template>

<script>
import secret from "../../../../const/ApiKey";
import NikkeiLineChart from "../../../module/NikkeiLineChart";

export default {
  data() {
    return {
      loading: true,
      nikkeData: [],
      lineChartData: {},
    };
  },
  components: {
    NikkeiLineChart,
  },
  mounted() {
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios
      .get(
        "https://www.quandl.com/api/v3/datasets/CHRIS/CME_NK2/data.json?api_key=" +
          secret.QUANDL_API_ACCESSKEY
      )
      .then((res) => {
        //console.log(res.data);
        // 0, 50, 100, 150 ...
        this.nikkeiData = res.data.dataset_data.data.reverse();
        this.lineChartData = Object.assign({}, this.lineChartData, {
          labels: this.nikkeiData.map((item) => item[0]),
          datasets: [
            // {
            //   label: ["始値"],
            //   fill: false,
            //   borderColor: "#FF6928",
            //   data: this.nikkeiData.map((item) => item[1]),
            //   hoverRadius: 10,
            // },
            {
              label: ["終値"],
              fill: false,
              borderColor: "#4DF9B9",
              data: this.nikkeiData.map((item) => item[4]),
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
