<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form v-on:submit.prevent="submit">
          <div class="form-group row">
            <label for="year" class="col-sm-3 col-form-label">Year</label>
            <input type="text" class="col-sm-9 form-control" id="year" v-model="bonus.year" />
          </div>
          <div class="form-group row">
            <label for="month" class="col-sm-3 col-form-label">Month</label>
            <input type="text" class="col-sm-9 form-control" id="month" v-model="bonus.month" />
          </div>
          <div class="form-group row">
            <label for="total-bonus" class="col-sm-3 col-form-label">total Bonus</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="total-bonus"
              v-model="bonus.totalBonus"
            />
          </div>
          <div class="form-group row">
            <label for="health-insurance" class="col-sm-3 col-form-label">health Insurance</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="health-insurance"
              v-model="bonus.healthInsurance"
            />
          </div>
          <div class="form-group row">
            <label for="employee-pension" class="col-sm-3 col-form-label">employee Pension</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="employee-pension"
              v-model="bonus.employeePension"
            />
          </div>
          <div class="form-group row">
            <label for="employment-insurance" class="col-sm-3 col-form-label">employment Insurance</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="employment-insurance"
              v-model="bonus.employmentInsurance"
            />
          </div>
          <div class="form-group row">
            <label for="income-tax" class="col-sm-3 col-form-label">income Tax</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="income-tax"
              v-model="bonus.incomeTax"
            />
          </div>
          <div class="form-group row">
            <label for="total-deduction" class="col-sm-3 col-form-label">total Deduction</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="total-deduction"
              v-model="bonus.totalDeduction"
            />
          </div>
          <div class="form-group row">
            <label for="net-income" class="col-sm-3 col-form-label">net Income</label>
            <input
              type="text"
              class="col-sm-9 form-control"
              id="net-income"
              v-model="bonus.netIncome"
            />
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
      bonus: {},
    };
  },
  methods: {
    submit() {
      axios.post("/api/bonus/store/", this.bonus).then((res) => {
        this.$router.push({ name: "bonus.rec-done" });
      });
    },
  },
};
</script>
