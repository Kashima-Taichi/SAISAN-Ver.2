<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">bank_id</th>
            <th scope="col">bank_name</th>
            <th scope="col">balance</th>
            <th scope="col">Edit</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">{{ balance.id }}</th>
            <td>{{ balance.bank_id }}</td>
            <td>{{ balance.bank_name }}</td>
            <td>{{ balance.balance.toLocaleString() }}</td>
            <td>
              <router-link v-bind:to="{name: 'banks.edit', params: { bankId: balance.id } }">
                <button class="btn btn-success">Edit</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.asset'}">
        <button class="btn btn-success mt-5" style="width:170px">資産管理メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    bankId: String,
  },
  data: function () {
    return {
      balance: [],
      loading: true,
    };
  },
  methods: {
    getBalanceIndividualData() {
      axios.get("/api/bank/detail/" + this.bankId + "/").then((res) => {
        this.balance = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getBalanceIndividualData();
  },
};
</script>
