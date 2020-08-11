<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>賞与明細修正完了</h2>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">year</th>
            <th scope="col">month</th>
            <th scope="col">total Bonus</th>
            <th scope="col">health Insurance</th>
            <th scope="col">employee Pension</th>
            <th scope="col">employment Insurance</th>
            <th scope="col">income Tax</th>
            <th scope="col">total Deduction</th>
            <th scope="col">net Income</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{ bonus.year }}</th>
            <td>{{ bonus.month }}</td>
            <td>{{ bonus.totalBonus.toLocaleString() }}</td>
            <td>{{ bonus.healthInsurance.toLocaleString() }}</td>
            <td>{{ bonus.employeePension.toLocaleString() }}</td>
            <td>{{ bonus.employmentInsurance.toLocaleString() }}</td>
            <td>{{ bonus.incomeTax.toLocaleString() }}</td>
            <td>{{ bonus.totalDeduction.toLocaleString() }}</td>
            <td>{{ bonus.netIncome.toLocaleString() }}</td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.bonus'}">
        <button class="btn btn-success mt-5" style="width:170px">賞与ノ部メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    bonusId: String,
  },
  data: function () {
    return {
      bonus: {},
      loading: true,
    };
  },
  methods: {
    getBonusIndividualData() {
      axios.get("/api/bonus/detail/" + this.bonusId + "/").then((res) => {
        this.bonus = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getBonusIndividualData();
  },
};
</script>
