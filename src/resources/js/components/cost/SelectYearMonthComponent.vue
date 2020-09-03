<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <form v-on:submit.prevent="submit">
        <select-year-cost v-model="year" @parentMethod="updateFlg"></select-year-cost>
        <select-month-cost v-model="month" @parentMethod="updateFlg"></select-month-cost>
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
import SelectMonthCost from "../module/SelectMonthCost";

export default {
  data: function () {
    return {
      // formから送信するデータ
      year: "",
      month: "",
      day: "",
      loading: true,
    };
  },
  components: {
    SelectYearCost,
    SelectMonthCost,
  },
  methods: {
    updateFlg() {
      this.loading = false;
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
};
</script>
