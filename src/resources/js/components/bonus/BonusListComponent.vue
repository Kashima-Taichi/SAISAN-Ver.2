<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
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
            <th scope="col">Watch</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(bonus, index) in bonuses" :key="index">
            <th scope="row">{{ bonus.year }}</th>
            <td>{{ bonus.month }}</td>
            <td>{{ bonus.totalBonus.toLocaleString() }}</td>
            <td>{{ bonus.healthInsurance.toLocaleString() }}</td>
            <td>{{ bonus.employeePension.toLocaleString() }}</td>
            <td>{{ bonus.employmentInsurance.toLocaleString() }}</td>
            <td>{{ bonus.incomeTax.toLocaleString() }}</td>
            <td>{{ bonus.totalDeduction.toLocaleString() }}</td>
            <td>{{ bonus.netIncome.toLocaleString() }}</td>
            <td>
              <router-link v-bind:to="{name: 'bonus.detail', params: { bonusId: bonus.id } }">
                <button class="btn btn-primary">Watch</button>
              </router-link>
            </td>
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
    year: Number,
  },
  data: function () {
    return {
      bonuses: [],
      loading: true,
    };
  },
  methods: {
    getBonusData() {
      axios.get("/api/bonus/list/" + this.year + "/").then((res) => {
        this.bonuses = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getBonusData();
  },
};
</script>
