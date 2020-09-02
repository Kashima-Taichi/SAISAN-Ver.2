<template>
  <div class="form-group">
    <label for="year">please select year</label>
    <select
      class="form-control"
      id="year"
      :value="year"
      @change="$emit('input', $event.target.value)"
    >
      <option value>select</option>
      <option v-for="(year, index) in years" :key="index" :value="year.year">{{ year.year }}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ["year"],
  data: function () {
    return {
      years: [],
    };
  },
  mounted() {
    axios.get("/api/cost/year/").then((res) => {
      this.years = res.data;
      this.$emit("parentMethod");
    });
  },
};
</script>
