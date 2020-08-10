<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">id</th>
          <th scope="col">accountAlpha</th>
          <th scope="col">accountKanji</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(accounts, index) in accounts" :key="index">
          <th scope="row">{{ accounts.id }}</th>
          <td>{{ accounts.accountAlpha }}</td>
          <td>{{ accounts.accountKanji }}</td>
        </tr>
      </tbody>
    </table>
    <router-link v-bind:to="{name: 'saisan.account'}">
      <button class="btn btn-success mt-5" style="width:190px">勘定科目ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      accounts: [],
    };
  },
  methods: {
    getAccountsData() {
      axios.get("/api/account/all/").then((res) => {
        this.accounts = res.data;
      });
    },
  },
  mounted() {
    this.getAccountsData();
  },
};
</script>
