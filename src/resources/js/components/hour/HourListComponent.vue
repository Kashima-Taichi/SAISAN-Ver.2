<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">id</th>
          <th scope="col">year</th>
          <th scope="col">month</th>
          <th scope="col">fixed time</th>
          <th scope="col">over time</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(hour, index) in hours" :key="index">
          <th scope="row">{{ hour.id }}</th>
          <td>{{ hour.year }}</td>
          <td>{{ hour.month }}</td>
          <td>{{ hour.fixedTime }}</td>
          <td>{{ hour.overTime }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    year: Number,
  },
  data: function () {
    return {
      hours: [],
    };
  },
  methods: {
    getHourData() {
      axios.get("/api/hour/list/" + this.year + "/").then((res) => {
        this.hours = res.data;
      });
    },
  },
  mounted() {
    this.getHourData();
  },
};
</script>
