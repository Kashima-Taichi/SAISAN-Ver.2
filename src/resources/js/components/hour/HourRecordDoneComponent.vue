<template>
  <div class="container">
    <h3>稼働時間計上完了</h3>
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">id</th>
          <th scope="col">fixed time</th>
          <th scope="col">over time</th>
          <th scope="col">year</th>
          <th scope="col">month</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">{{ hour.id }}</th>
          <td>{{ hour.fixedTime }}</td>
          <td>{{ hour.overTime }}</td>
          <td>{{ hour.year }}</td>
          <td>{{ hour.month }}</td>
        </tr>
      </tbody>
      <router-link v-bind:to="{name: 'saisan.hour'}">
        <button class="btn btn-success">time menu</button>
      </router-link>
    </table>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      hour: [],
    };
  },
  methods: {
    getHourLatestData() {
      axios.get("/api/hour/latest/").then((res) => {
        this.hour = res.data;
      });
    },
  },
  mounted() {
    this.getHourLatestData();
  },
};
</script>
