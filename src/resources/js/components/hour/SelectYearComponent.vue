<template>
  <div class="container">
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
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      // formで使用するデータ
      years: [],
      // formから送信するデータ
      year: "",
    };
  },
  methods: {
    // 年月の情報を取得
    getHourYear() {
      axios.get("/api/hour/year").then((res) => {
        this.years = res.data;
      });
    },
    submit() {
      this.$router.push({
        name: "hour.list",
        params: { year: this.year },
      });
    },
  },
  mounted() {
    this.getHourYear();
  },
};
</script>
