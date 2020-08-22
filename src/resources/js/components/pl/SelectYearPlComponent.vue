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
      // formから送信するデータ
      year: "",
      loading: true,
    };
  },
  methods: {
    // 年月の情報を取得(経費計上実績準拠)
    getCostYear() {
      axios.get("/api/cost/year/").then((res) => {
        this.years = res.data;
        this.loading = false;
      });
    },
    submit() {
      this.$router.push({
        name: "pl.yearly",
        params: { year: this.year },
      });
    },
  },
  mounted() {
    this.getCostYear();
  },
};
</script>
