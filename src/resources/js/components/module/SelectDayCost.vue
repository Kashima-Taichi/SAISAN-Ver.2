<template>
  <div class="form-group">
    <label for="day">please select day</label>
    <select
      class="form-control"
      id="day"
      :value="day"
      @change="$emit('input', $event.target.value)"
    >
      <option value>select</option>
      <option v-for="i in 31" :key="i" :value="i">{{ i }}</option>
    </select>
  </div>
</template>

<script>
export default {
  props: ["day"],
};
</script>
