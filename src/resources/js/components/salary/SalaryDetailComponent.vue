<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
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
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{ salary.id }}</th>
            <td>{{ parseInt(salary.totalSalary).toLocaleString() }}</td>
            <td>{{ parseInt(salary.basicSalary).toLocaleString() }}</td>
            <td>{{ parseInt(salary.overtimePay).toLocaleString() }}</td>
            <td>{{ parseInt(salary.healthInsurance).toLocaleString() }}</td>
            <td>{{ parseInt(salary.employeePension).toLocaleString() }}</td>
            <td>{{ parseInt(salary.employmentInsurance).toLocaleString() }}</td>
            <td>{{ parseInt(salary.incomeTax).toLocaleString() }}</td>
            <td>{{ parseInt(salary.residentTax).toLocaleString() }}</td>
            <td>{{ parseInt(salary.otherDeduction).toLocaleString() }}</td>
            <td>{{ parseInt(salary.totalDeduction).toLocaleString() }}</td>
            <td>{{ parseInt(salary.netIncome).toLocaleString() }}</td>
            <td>
              <router-link v-bind:to="{name: 'salary.edit', params: { salaryId: salary.id } }">
                <button class="btn btn-success">Edit</button>
              </router-link>
            </td>
            <td>
              <button v-on:click="deleteSalary(salary.id)" class="btn btn-danger">Delete</button>
            </td>
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
    salaryId: Number,
  },
  data: function () {
    return {
      loading: true,
      salary: {},
    };
  },
  methods: {
    deleteSalary(id) {
      axios.delete("/api/salary/delete/" + id + "/").then((res) => {
        this.$router.push({ name: "salary.delete-done" });
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
