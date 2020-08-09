<template>
  <div class="container">
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
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
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
          <td>
            <button class="btn btn-success">Edit</button>
          </td>
          <td>
            <button class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    costId: Number,
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
