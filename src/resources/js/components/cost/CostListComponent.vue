<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>経費計上合計金額：{{ calcTotal }}円</h2>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">account</th>
            <th scope="col">price</th>
            <th scope="col">journal</th>
            <th scope="col">year</th>
            <th scope="col">month</th>
            <th scope="col">day</th>
            <th scope="col">Watch</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(cost, index) in costs" :key="index">
            <th scope="row">{{ cost.id }}</th>
            <td>{{ cost.accountName }}</td>
            <td>{{ parseInt(cost.price).toLocaleString() }}</td>
            <td>{{ cost.journal }}</td>
            <td>{{ cost.year }}</td>
            <td>{{ cost.month }}</td>
            <td>{{ cost.day }}</td>
            <td>
              <router-link v-bind:to="{name: 'cost.detail', params: { costId: cost.id } }">
                <button class="btn btn-primary">Watch</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    year: String,
    month: Number,
    day: Number,
  },
  data: function () {
    return {
      costs: [],
      totalAmount: 0,
      loading: true,
    };
  },
  methods: {
    getCostData() {
      if (this.day === undefined) {
        axios
          .get("/api/cost/list/" + this.year + "/" + this.month + "/")
          .then((res) => {
            this.costs = res.data;
            this.loading = false;
          });
      } else {
        axios
          .get(
            "/api/cost/list/" +
              this.year +
              "/" +
              this.month +
              "/" +
              this.day +
              "/"
          )
          .then((res) => {
            this.costs = res.data;
            this.loading = false;
          });
      }
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
    this.getCostData();
  },
};
</script>
