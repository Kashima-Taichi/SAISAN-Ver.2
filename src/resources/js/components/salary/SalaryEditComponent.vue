<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <h2>所得計上明細の修正</h2>
          <form v-on:submit.prevent="submit">
            <div class="form-group row">
              <label for="year" class="col-sm-3 col-form-label">Year</label>
              <input type="text" class="col-sm-9 form-control" id="year" v-model="salary.year" />
            </div>
            <div class="form-group row">
              <label for="month" class="col-sm-3 col-form-label">Month</label>
              <input type="text" class="col-sm-9 form-control" id="month" v-model="salary.month" />
            </div>
            <div class="form-group row">
              <label for="total-salary" class="col-sm-3 col-form-label">total Salary</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="total-salary"
                v-model="salary.totalSalary"
              />
            </div>
            <div class="form-group row">
              <label for="basic-salary" class="col-sm-3 col-form-label">basic Salary</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="basic-salary"
                v-model="salary.basicSalary"
              />
            </div>
            <div class="form-group row">
              <label for="overtime-pay" class="col-sm-3 col-form-label">overtime Pay</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="overtime-pay"
                v-model="salary.overtimePay"
              />
            </div>
            <div class="form-group row">
              <label for="health-insurance" class="col-sm-3 col-form-label">health Insurance</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="health-insurance"
                v-model="salary.healthInsurance"
              />
            </div>
            <div class="form-group row">
              <label for="employee-pension" class="col-sm-3 col-form-label">employee Pension</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="employee-pension"
                v-model="salary.employeePension"
              />
            </div>
            <div class="form-group row">
              <label for="employment-insurance" class="col-sm-3 col-form-label">employment Insurance</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="employment-insurance"
                v-model="salary.employmentInsurance"
              />
            </div>
            <div class="form-group row">
              <label for="income-tax" class="col-sm-3 col-form-label">income Tax</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="income-tax"
                v-model="salary.incomeTax"
              />
            </div>
            <div class="form-group row">
              <label for="resident-tax" class="col-sm-3 col-form-label">resident Tax</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="resident-tax"
                v-model="salary.residentTax"
              />
            </div>
            <div class="form-group row">
              <label for="other-deduction" class="col-sm-3 col-form-label">other Deduction</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="other-deduction"
                v-model="salary.otherDeduction"
              />
            </div>
            <div class="form-group row">
              <label for="total-deduction" class="col-sm-3 col-form-label">total Deduction</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="total-deduction"
                v-model="salary.totalDeduction"
              />
            </div>
            <div class="form-group row">
              <label for="net-income" class="col-sm-3 col-form-label">net Income</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="net-income"
                v-model="salary.netIncome"
              />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    salaryId: String,
  },
  data: function () {
    return {
      salary: {},
      loading: true,
    };
  },
  methods: {
    submit() {
      axios.put("/api/salary/edit/", this.salary).then((res) => {
        this.$router.push({ name: "salary.edit-done" });
      });
    },
    getSalaryIndividualData() {
      axios.get("/api/salary/detail/" + this.salaryId + "/").then((res) => {
        this.salary = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getSalaryIndividualData();
  },
};
</script>
