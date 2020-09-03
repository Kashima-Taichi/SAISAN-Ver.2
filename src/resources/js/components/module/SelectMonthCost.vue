<template>
  <div class="form-group">
    <label for="month">please select month</label>
    <select
      class="form-control"
      id="month"
      :value="month"
      @change="$emit('input', $event.target.value)"
    >
      <option value>select</option>
      <option v-for="(month, index) in months" :key="index" :value="month.month">{{ month.month }}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ["month"],
  data: function () {
    return {
      months: [],
    };
  },
  mounted() {
    axios.get("/api/cost/month/").then((res) => {
      this.months = res.data;
      this.$emit("parentMethod");
    });
  },
};
</script>
