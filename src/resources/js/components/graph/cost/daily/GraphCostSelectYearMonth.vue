<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <form v-on:submit.prevent="submit">
        <div class="form-group">
          <label for="year">please select year</label>
          <select class="form-control" id="year" v-model="year">
            <option value>select</option>
            <option
              v-for="(year, index) in years"
              :key="index"
              v-bind:value="year.year"
            >{{ year.year }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="month">please select month</label>
          <select class="form-control" id="month" v-model="month">
            <option value>select</option>
            <option
              v-for="(month, index) in months"
              :key="index"
              v-bind:value="month.month"
            >{{ month.month }}</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      // formで使用するデータ
      years: [],
      months: [],
      // formから送信するデータ
      year: "",
      month: "",
      loading: true,
    };
  },
  methods: {
    // 年月の情報を取得
    getCostYearMonth() {
      axios.get("/api/cost/year/").then((res) => {
        this.years = res.data;
      });
      axios.get("/api/cost/month/").then((res) => {
        this.months = res.data;
        this.loading = false;
      });
    },
    submit() {
      this.$router.push({
        name: "graph.cost.daily",
        params: { year: this.year, month: this.month },
      });
    },
  },
  mounted() {
    this.getCostYearMonth();
  },
};
</script>
