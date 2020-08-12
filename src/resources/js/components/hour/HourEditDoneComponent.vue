<template>
  <div class="container">
    <h2>稼働時間明細修正完了</h2>
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
        <tr>
          <th scope="row">{{ hour.id }}</th>
          <td>{{ hour.year }}</td>
          <td>{{ hour.month }}</td>
          <td>{{ hour.fixedTime }}</td>
          <td>{{ hour.overTime }}</td>
        </tr>
      </tbody>
    </table>
    <router-link v-bind:to="{name: 'saisan.hour'}">
      <button class="btn btn-success mt-5" style="width:170px">時間ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  props: {
    hourId: Number,
  },
  data: function () {
    return {
      hour: {},
    };
  },
  methods: {
    getHourIndividualData() {
      axios.get("/api/hour/detail/" + this.hourId + "/").then((res) => {
        this.hour = res.data;
      });
    },
  },
  mounted() {
    this.getHourIndividualData();
  },
};
</script>
