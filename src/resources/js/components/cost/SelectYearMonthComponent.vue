<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <form v-on:submit.prevent="submit">
        <select-year-cost v-model="year" @parentMethod="updateFlg"></select-year-cost>
        <select-month-cost v-model="month" @parentMethod="updateFlg"></select-month-cost>
        <select-day-cost v-model="day"></select-day-cost>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>
<script>
import SelectYearCost from "../module/SelectYearCost";
import SelectMonthCost from "../module/SelectMonthCost";
import SelectDayCost from "../module/SelectDayCost";

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
    SelectDayCost,
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
