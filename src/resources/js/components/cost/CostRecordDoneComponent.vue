<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h3>経費計上完了</h3>
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
          </tr>
        </thead>
        <tbody>
          <tr :class="{ 'txt-tm': cost.rakuten == 1, 'txt-pur': cost.dependency == 1 }">
            <th scope="row">{{ cost.id }}</th>
            <td>{{ cost.accountName }}</td>
            <td>{{ numberFormat }}</td>
            <td>{{ cost.journal }}</td>
            <td>{{ cost.year }}</td>
            <td>{{ cost.month }}</td>
            <td>{{ cost.day }}</td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'cost.rec'}">
        <button class="btn btn-success mt-5">続けて経費計上</button>
      </router-link>
      <router-link
        v-bind:to="{name: 'cost.list-month', params: {year: this.year, month: this.month}}"
      >
        <button class="btn btn-success mt-5 ml-5">今月の計上経費を参照</button>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    var now = new Date();
    return {
      loading: true,
      cost: [],
      year: String(now.getFullYear()),
      month: String(now.getMonth() + 1),
    };
  },
  methods: {
    getCostLatestData() {
      axios.get("/api/cost/latest/").then((res) => {
        this.cost = res.data;
        this.loading = false;
      });
    },
  },
  computed: {
    numberFormat: function () {
      return parseInt(this.cost.price).toLocaleString();
    },
  },
  mounted() {
    this.getCostLatestData();
  },
};
</script>
