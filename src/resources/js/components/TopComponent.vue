<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2 align="center" class="mb-4">{{ year }}年{{ month }}月度 PL</h2>
      <table class="table table-hover w-50" align="center">
        <thead class="thead-light">
          <tr>
            <th scope="col">項目</th>
            <th scope="col">金額</th>
          </tr>
        </thead>
        <tbody>
          <tr class="txt-lg" v-show="salary">
            <th scope="row">給与(総支給)</th>
            <td>{{ parseInt(salary.totalSalary).toLocaleString() }}</td>
          </tr>
          <tr class="txt-lg" v-show="salary">
            <th scope="row">給与(手取り)</th>
            <td>{{ parseInt(salary.netIncome).toLocaleString() }}</td>
          </tr>
          <tr class="txt-lg" v-show="bonus">
            <th scope="row">賞与(総支給)</th>
            <td>{{ parseInt(bonus.totalBonus).toLocaleString() }}</td>
          </tr>
          <tr class="txt-lg" v-show="bonus">
            <th scope="row">賞与(手取り)</th>
            <td>{{ parseInt(bonus.netIncome).toLocaleString() }}</td>
          </tr>
          <tr class="txt-g" v-show="salary">
            <th scope="row">収入合計</th>
            <td>{{ incomeAmount }}</td>
          </tr>
          <tr class="txt-lr" v-for="(cost, index) in costs" :key="index" v-show="costs">
            <th scope="row">{{ cost.accountName }}</th>
            <td>{{ parseInt(cost.accountAmount).toLocaleString() }}</td>
          </tr>
          <tr class="txt-r" v-show="costs">
            <th scope="row">経費合計</th>
            <td>{{ costAmount }}</td>
          </tr>
          <tr class="txt-y" v-show="salary">
            <th scope="row">差引貯蓄可能額</th>
            <td>{{ netSaving }}</td>
          </tr>
          <tr class="txt-lb" v-show="hour">
            <th scope="row">定時間</th>
            <td>{{ hour.fixedTime }}</td>
          </tr>
          <tr class="txt-lb" v-show="hour">
            <th scope="row">残業時間</th>
            <td>{{ hour.overTime }}</td>
          </tr>
          <tr class="txt-b" v-show="hour">
            <th scope="row">総労働時間</th>
            <td>{{ timeAmount }}</td>
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
      bonus: {},
      costs: [],
      hour: {},
      totalExpense: 0,
      totalCost: 0,
      year: now.getFullYear(),
      month: now.getMonth() + 1,
    };
  },
  methods: {
    getPlData() {
      axios
        .get("/api/salary/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.salary = res.data;
        });
      axios
        .get("/api/bonus/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.bonus = res.data;
        });
      axios
        .get("/api/hour/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.hour = res.data;
        });
      axios
        .get("/api/cost/pl/" + this.year + "/" + this.month + "/")
        .then((res) => {
          this.costs = res.data;
          this.loading = false;
        });
    },
  },
  computed: {
    costAmount: function () {
      for (var item in this.costs) {
        this.totalExpense += parseInt(this.costs[item]["accountAmount"]);
      }
      return this.totalExpense.toLocaleString();
    },
    timeAmount: function () {
      return this.hour.fixedTime + this.hour.overTime;
    },
    incomeAmount: function () {
      if (this.bonus === "") {
        return parseInt(this.salary.netIncome).toLocaleString();
      } else {
        return parseInt(
          this.salary.netIncome + this.bonus.netIncome
        ).toLocaleString();
      }
    },
    netSaving: function () {
      // 経費合計額の算出
      for (var item in this.costs) {
        this.totalCost += parseInt(this.costs[item]["accountAmount"]);
      }
      // 差引貯蓄額の計算
      if (this.bonus === "") {
        return parseInt(
          this.salary.netIncome - this.totalCost
        ).toLocaleString();
      } else {
        return parseInt(
          this.salary.netIncome + this.bonus.netIncome - this.totalCost
        ).toLocaleString();
      }
    },
  },
  mounted() {
    this.getPlData();
  },
};
</script>
