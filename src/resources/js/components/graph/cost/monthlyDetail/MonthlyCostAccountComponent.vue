<script>
// TODO : template内で出力させるようにリファクタする
import { Doughnut } from "vue-chartjs";
import * as palette from "google-palette";

export default {
  extends: Doughnut,
  props: {
    year: Number,
    month: Number,
  },
  data() {
    return {
      doughnutChartData: {},
      monthlyCostAccount: {},
    };
  },
  mounted() {
    this.$refs.canvas.height = 200;
    // APIでのデータ取得を実行して、チャートの描画を実行する
    axios
      .get("/api/cost/account/monthly/" + this.year + "/" + this.month + "/")
      .then((res) => {
        this.monthlyCostAccount = res.data;
        this.renderChart({
          labels: this.monthlyCostAccount.map((item) => item.accountName),
          datasets: [
            {
              backgroundColor: palette(
                "mpn65",
                this.monthlyCostAccount.length
              ).map(function (hex) {
                return "#" + hex;
              }),
              data: this.monthlyCostAccount.map((item) => item.accountAmount),
            },
          ],
        }),
          { responsive: true, maintainAspectRatio: false };
      });
  },
};
</script>
