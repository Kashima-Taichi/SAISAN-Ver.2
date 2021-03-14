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
            <td>{{ totalFormat }}</td>
            <td>{{ cashFormat }}</td>
          </tr>
        </tbody>
      </table>
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
        this.loading = false;
      });
    },
  },
  computed: {
    totalFormat: function () {
      return parseInt(this.capital.total).toLocaleString();
    },
    cashFormat: function () {
      return parseInt(this.capital.cash).toLocaleString();
    },
  },
  mounted() {
    this.getCapitalLatestData();
  },
};
</script>
