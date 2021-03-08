<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <validation-provider rules="required" v-slot="{ errors }">
            <div class="form-group row mb-5 mt-5">
              <label for="year" class="col-sm-3 col-form-label">Year</label>
              <input type="text" class="col-sm-9 form-control" id="year" v-model="capital.year" />
              <span class="mt-2 txt-tm">{{ errors[0] }}</span>
            </div>
          </validation-provider>

          <validation-provider rules="required" v-slot="{ errors }">
            <div class="form-group row mb-5">
              <label for="month" class="col-sm-3 col-form-label">Month</label>
              <input type="text" class="col-sm-9 form-control" id="month" v-model="capital.month" />
              <span class="mt-2 txt-tm">{{ errors[0] }}</span>
            </div>
          </validation-provider>

          <validation-provider rules="required" v-slot="{ errors }">
            <div class="form-group row mb-5">
              <label for="total" class="col-sm-3 col-form-label">Total</label>
              <input type="text" class="col-sm-9 form-control" id="total" v-model="capital.total" />
              <span class="mt-2 txt-tm">{{ errors[0] }}</span>
            </div>
          </validation-provider>

          <validation-provider rules="required" v-slot="{ errors }">
            <div class="form-group row mb-5">
              <label for="cash" class="col-sm-3 col-form-label">Cash</label>
              <input type="text" class="col-sm-9 form-control" id="cash" v-model="capital.cash" />
              <span class="mt-2 txt-tm">{{ errors[0] }}</span>
            </div>
          </validation-provider>

          <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "This field is required",
});

export default {
  data: function () {
    return {
      capital: {},
    };
  },
  components: {
    ValidationProvider,
  },
  methods: {
    submit() {
      axios.post("/api/capital/store/", this.capital).then((res) => {
        this.$router.push({ name: "capitals.rec-done" });
      });
    },
    fillDateInfo() {
      var now = new Date();
      this.capital.year = now.getFullYear();
      this.capital.month = now.getMonth() + 1;
    },
  },
  mounted() {
    this.fillDateInfo();
  },
};
</script>
