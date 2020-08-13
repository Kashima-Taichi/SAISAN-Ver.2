<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
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
            <td>{{ parseInt(cost.price).toLocaleString() }}</td>
            <td>{{ cost.journal }}</td>
            <td>{{ cost.year }}</td>
            <td>{{ cost.month }}</td>
            <td>{{ cost.day }}</td>
            <td>
              <router-link v-bind:to="{name: 'cost.edit', params: { costId: cost.id } }">
                <button class="btn btn-success">Edit</button>
              </router-link>
            </td>
            <td>
              <button v-on:click="deleteCost(cost.id)" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.cost'}">
        <button class="btn btn-success mt-5" style="width:170px">経費ノ部メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    costId: Number,
  },
  data: function () {
    return {
      loading: true,
      cost: {},
    };
  },
  methods: {
    deleteCost(id) {
      axios.delete("/api/cost/delete/" + id + "/").then((res) => {
        this.$router.push({ name: "cost.delete-done" });
      });
    },
    getCostIndividualData() {
      axios.get("/api/cost/detail/" + this.costId + "/").then((res) => {
        this.cost = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getCostIndividualData();
  },
};
</script>
