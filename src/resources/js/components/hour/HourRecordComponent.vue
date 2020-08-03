<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="year" class="col-sm-3 col-form-label">Year</label>
            <input type="text" class="col-sm-9 form-control" id="year" v-model="hour.year" />
          </div>
          <div class="form-group row">
            <label for="month" class="col-sm-3 col-form-label">Month</label>
            <input type="text" class="col-sm-9 form-control" id="month" v-model="hour.month" />
          </div>
          <div class="form-group row">
            <label for="fixedTime" class="col-sm-3 col-form-label">fixedTime</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="fixedTime"
              v-model="hour.fixedTime"
            />
          </div>
          <div class="form-group row">
            <label for="overTime" class="col-sm-3 col-form-label">overTime</label>
            <input type="text" class="col-sm-9 form-control" id="overTime" v-model="hour.overTime" />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      hour: {},
    };
  },
  methods: {
    submit() {
      axios.post("/api/hour/store", this.hour).then((res) => {
        this.$router.push({ name: "hour.rec-done" });
      });
    },
  },
};
</script>
