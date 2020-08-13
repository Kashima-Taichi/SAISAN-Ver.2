<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>{{ year }}年{{ month }}月度 PL</h2>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">項目</th>
            <th scope="col">金額</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">給与(総支給)</th>
            <td>{{ salary.totalSalary }}</td>
          </tr>
          <tr>
            <th scope="row">給与(手取り)</th>
            <td>{{ salary.netIncome }}</td>
          </tr>
          <tr v-for="(cost, index) in costs" :key="index">
            <th scope="row">{{ cost.accountName }}</th>
            <td>{{ parseInt(cost.accountAmount).toLocaleString() }}</td>
          </tr>
          <tr>
            <th scope="row">経費合計</th>
            <td>{{ costAmount }}</td>
          </tr>
          <tr>
            <th scope="row">定時間</th>
            <td>{{ hour.fixedTime }}</td>
          </tr>
          <tr>
            <th scope="row">残業時間</th>
            <td>{{ hour.overTime }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    var now = new Date();
    return {
      loading: true,
      salary: {},
      costs: [],
      hour: {},
      totalAmount: 0,
      year: now.getFullYear(),
      month: now.getMonth() + 1,
    };
  },
  methods: {
    getCurrentSalaryData() {
      axios
        .get("/api/salary/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.salary = res.data;
        });
    },
    getCurrentCostData() {
      axios
        .get("/api/cost/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.costs = res.data;
          this.loading = false;
        });
    },
    getCurrentHourData() {
      axios
        .get("/api/hour/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.hour = res.data;
        });
    },
  },
  computed: {
    costAmount: function () {
      for (var item in this.costs) {
        this.totalAmount += parseInt(this.costs[item]["accountAmount"]);
      }
      return this.totalAmount.toLocaleString();
    },
  },
  mounted() {
    this.getCurrentSalaryData();
    this.getCurrentHourData();
    this.getCurrentCostData();
  },
};
</script>
