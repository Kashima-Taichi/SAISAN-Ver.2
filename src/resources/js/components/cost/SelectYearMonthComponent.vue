<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <form v-on:submit.prevent="submit">
        <select-year-cost v-model="year" @parentMethod="updateFlg"></select-year-cost>
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
        <div class="form-group">
          <label for="day">please select day</label>
          <select class="form-control" id="day" v-model="day">
            <option value>select</option>
            <option v-for="i in 31" :key="i" :value="i">{{ i }}</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>
<script>
import SelectYearCost from "../module/SelectYearCost";

export default {
  data: function () {
    return {
      // formで使用するデータ
      months: [],
      // formから送信するデータ
      year: "",
      month: "",
      day: "",
      loading: true,
    };
  },
  components: {
    SelectYearCost,
  },
  methods: {
    updateFlg() {
      this.loading = false;
    },
    // 年月の情報を取得
    getCostMonth() {
      axios.get("/api/cost/month/").then((res) => {
        this.months = res.data;
        this.loading = false;
      });
    },
    submit() {
      if (this.day === "") {
        this.$router.push({
          name: "cost.list-month",
          params: { year: this.year, month: this.month },
        });
      } else {
        this.$router.push({
          name: "cost.list-day",
          params: { year: this.year, month: this.month, day: this.day },
        });
      }
    },
  },
  mounted() {
    this.getCostMonth();
  },
};
</script>
