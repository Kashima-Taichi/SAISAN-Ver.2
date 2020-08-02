<template>
  <div class="container">
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
        <tr>
          <th scope="row">{{ cost.id }}</th>
          <td>{{ cost.accountName }}</td>
          <td>{{ cost.price }}</td>
          <td>{{ cost.journal }}</td>
          <td>{{ cost.year }}</td>
          <td>{{ cost.month }}</td>
          <td>{{ cost.day }}</td>
        </tr>
      </tbody>
      <router-link v-bind:to="{name: 'cost.rec'}">
        <button class="btn btn-success">続けて経費計上</button>
      </router-link>
    </table>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      cost: [],
    };
  },
  methods: {
    getCostLatestData() {
      axios.get("/api/cost/latest/").then((res) => {
        this.cost = res.data;
      });
    },
  },
  mounted() {
    this.getCostLatestData();
  },
};
</script>
