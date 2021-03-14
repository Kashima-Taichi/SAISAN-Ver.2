<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">year</th>
            <th scope="col">month</th>
            <th scope="col">total</th>
            <th scope="col">cash</th>
            <th scope="col">cash ratio</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(capital, index) in capitals" :key="index">
            <th scope="row">{{ capital.year }}</th>
            <td>{{ capital.month }}</td>
            <td>{{ capital.total.toLocaleString() }}</td>
            <td>{{ capital.cash.toLocaleString() }}</td>
            <td>{{ Math.round((capital.cash / capital.total) * 100) + "%" }}</td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.asset'}">
        <button class="btn btn-success mt-5" style="width:170px">資産ノ部メニューへ</button>
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
      capitals: [],
      loading: true,
    };
  },
  methods: {
    getCapitalData() {
      axios.get("/api/capital/list/" + this.year + "/").then((res) => {
        this.capitals = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getCapitalData();
  },
};
</script>
