<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h3>資産評価額計上完了</h3>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">year</th>
            <th scope="col">month</th>
            <th scope="col">total</th>
            <th scope="col">cash</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{ capital.id }}</th>
            <td>{{ capital.year }}</td>
            <td>{{ capital.month }}</td>
            <td>{{ capital.total }}</td>
            <td>{{ capital.cash }}</td>
          </tr>
        </tbody>
      </table>
      <!-- <router-link v-bind:to="{name: 'cost.list-selecty'}">
        <button class="btn btn-success mt-5 ml-5">資産評価額推移を参照する</button>
      </router-link>-->
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    var now = new Date();
    return {
      loading: true,
      capital: [],
    };
  },
  methods: {
    getCapitalLatestData() {
      axios.get("/api/capital/latest/").then((res) => {
        this.capital = res.data;
        console.log(this.capital);
        this.loading = false;
      });
    },
  },
  computed: {
    numberFormat: function () {
      return parseInt(this.capital.total).toLocaleString();
      return parseInt(this.capital.cash).toLocaleString();
    },
  },
  mounted() {
    this.getCapitalLatestData();
  },
};
</script>
