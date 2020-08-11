<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>{{ salary.year }}年 {{ salary.month }}月 所得明細修正完了</h2>
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">total Salary</th>
            <th scope="col">basic Salary</th>
            <th scope="col">overtime Pay</th>
            <th scope="col">health Insurance</th>
            <th scope="col">employee Pension</th>
            <th scope="col">employment Insurance</th>
            <th scope="col">income Tax</th>
            <th scope="col">resident Tax</th>
            <th scope="col">other Deduction</th>
            <th scope="col">total Deduction</th>
            <th scope="col">net Income</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{ salary.id }}</th>
            <td>{{ salary.totalSalary.toLocaleString() }}</td>
            <td>{{ salary.basicSalary.toLocaleString() }}</td>
            <td>{{ salary.overtimePay.toLocaleString() }}</td>
            <td>{{ salary.healthInsurance.toLocaleString() }}</td>
            <td>{{ salary.employeePension.toLocaleString() }}</td>
            <td>{{ salary.employmentInsurance.toLocaleString() }}</td>
            <td>{{ salary.incomeTax.toLocaleString() }}</td>
            <td>{{ salary.residentTax.toLocaleString() }}</td>
            <td>{{ salary.otherDeduction.toLocaleString() }}</td>
            <td>{{ salary.totalDeduction.toLocaleString() }}</td>
            <td>{{ salary.netIncome.toLocaleString() }}</td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.salary'}">
        <button class="btn btn-success mt-5" style="width:170px">収入ノ部メニューへ</button>
      </router-link>
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
