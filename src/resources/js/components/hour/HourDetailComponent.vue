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
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{ hour.id }}</th>
            <td>{{ hour.year }}</td>
            <td>{{ hour.month }}</td>
            <td>{{ hour.fixedTime }}</td>
            <td>{{ hour.overTime }}</td>
            <td>
              <router-link v-bind:to="{name: 'hour.edit', params: { hourId: hour.id } }">
                <button class="btn btn-success">Edit</button>
              </router-link>
            </td>
            <td>
              <button v-on:click="deleteHour(hour.id)" class="btn btn-danger">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.hour'}">
        <button class="btn btn-success mt-5" style="width:170px">時間ノ部メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    hourId: Number,
  },
  data: function () {
    return {
      loading: true,
      hour: {},
    };
  },
  methods: {
    deleteHour(id) {
      axios.delete("/api/hour/delete/" + id + "/").then((res) => {
        this.$router.push({ name: "hour.delete-done" });
      });
    },
    getHourIndividualData() {
      axios.get("/api/hour/detail/" + this.hourId + "/").then((res) => {
        this.hour = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getHourIndividualData();
  },
};
</script>
