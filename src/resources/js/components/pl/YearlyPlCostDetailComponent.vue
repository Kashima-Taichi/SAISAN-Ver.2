<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>{{ year }}年 {{ accountName }} : {{ calcTotal }}円の内訳</h2>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">price</th>
            <th scope="col">journal</th>
            <th scope="col">month</th>
            <th scope="col">day</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cost, index) in costs" :key="index">
            <th scope="row">{{ cost.id }}</th>
            <td>{{ parseInt(cost.price).toLocaleString() }}</td>
            <td>{{ cost.journal }}</td>
            <td>{{ cost.month }}</td>
            <td>{{ cost.day }}</td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.pl'}">
        <button class="btn btn-success mt-5" style="width:170px">PLノ部メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    year: Number,
    account: String,
    accountName: String,
  },
  data: function () {
    return {
      loading: true,
      costs: [],
      totalAmount: 0,
    };
  },
  methods: {
    getCostAccountData() {
      axios
        .get("/api/cost/" + this.year + "/" + this.account + "/")
        .then((res) => {
          this.costs = res.data;
          this.loading = false;
        });
    },
  },
  computed: {
    calcTotal: function () {
      for (var item in this.costs) {
        this.totalAmount += this.costs[item]["price"];
      }
      return parseInt(this.totalAmount).toLocaleString();
    },
  },
  mounted() {
    this.getCostAccountData();
  },
};
</script>
