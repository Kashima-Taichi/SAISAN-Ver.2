<template>
  <div class="container">
    <h2>{{ salary.year }}年 {{ salary.month }}月 所得計上明細</h2>
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
          <th scope="col">Edit</th>
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
          <td>
            <router-link v-bind:to="{name: 'salary.edit', params: { salaryId: salary.id } }">
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    salaryId: Number,
  },
  data: function () {
    return {
      salary: {},
    };
  },
  methods: {
    getSalaryIndividualData() {
      axios.get("/api/salary/detail/" + this.salaryId + "/").then((res) => {
        this.salary = res.data;
      });
    },
  },
  mounted() {
    this.getSalaryIndividualData();
  },
};
</script>
