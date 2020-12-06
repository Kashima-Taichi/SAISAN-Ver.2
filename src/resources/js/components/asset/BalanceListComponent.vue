<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">bank_id</th>
            <th scope="col">bank_name</th>
            <th scope="col">balance</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(balance, index) in balances" :key="index">
            <th scope="row">{{ balance.id }}</th>
            <td>{{ balance.bank_id }}</td>
            <td>{{ balance.bank_name }}</td>
            <td>{{ balance.balance.toLocaleString() }}</td>
          </tr>
        </tbody>
      </table>
      <p class="mt-5">
        <strong>預金総額 ： {{ calcTotal }}</strong>
      </p>
      <router-link v-bind:to="{name: 'saisan.asset'}">
        <button class="btn btn-success mt-5" style="width:170px">資産管理メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      balances: [],
      totalAmount: 0,
      loading: true,
    };
  },
  methods: {
    getBalanceData() {
      axios.get("/api/bank/balance/").then((res) => {
        this.balances = res.data;
        this.loading = false;
      });
    },
  },
  computed: {
    calcTotal: function () {
      for (var item in this.balances) {
        this.totalAmount += this.balances[item]["balance"];
      }
      return parseInt(this.totalAmount).toLocaleString();
    },
  },
  mounted() {
    this.getBalanceData();
  },
};
</script>
