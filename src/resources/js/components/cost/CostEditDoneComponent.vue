<template>
  <div class="container">
    <h2>経費明細修正完了</h2>
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
          <td>{{ cost.price.toLocaleString() }}</td>
          <td>{{ cost.journal }}</td>
          <td>{{ cost.year }}</td>
          <td>{{ cost.month }}</td>
          <td>{{ cost.day }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    costId: String,
  },
  data: function () {
    return {
      cost: {},
    };
  },
  methods: {
    getCostIndividualData() {
      axios.get("/api/cost/detail/" + this.costId + "/").then((res) => {
        this.cost = res.data;
      });
    },
  },
  mounted() {
    this.getCostIndividualData();
  },
};
</script>
