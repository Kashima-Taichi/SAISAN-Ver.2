<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <form v-on:submit.prevent="submit">
        <select-year-cost v-model="year" @parentMethod="updateFlg"></select-year-cost>
        <select-month-cost v-model="month" @parentMethod="updateFlg"></select-month-cost>
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
      year: "",
      month: "",
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
      this.$router.push({
        name: "cost.business",
        params: { year: this.year, month: this.month },
      });
    },
  },
};
</script>
