<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">year</th>
            <th scope="col">month</th>
            <th scope="col">fixed time</th>
            <th scope="col">over time</th>
            <th scope="col">Watch</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(hour, index) in hours" :key="index">
            <th scope="row">{{ hour.id }}</th>
            <td>{{ hour.year }}</td>
            <td>{{ hour.month }}</td>
            <td>{{ hour.fixedTime }}</td>
            <td>{{ hour.overTime }}</td>
            <td>
              <router-link v-bind:to="{name: 'hour.detail', params: { hourId: hour.id } }">
                <button class="btn btn-primary">Watch</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
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
      hours: [],
      loading: true,
    };
  },
  methods: {
    getHourData() {
      axios.get("/api/hour/list/" + this.year + "/").then((res) => {
        this.hours = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getHourData();
  },
};
</script>
