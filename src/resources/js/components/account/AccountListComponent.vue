<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <table class="table table-hover">
        <thead class="thead-light">
          <tr>
            <th scope="col">id</th>
            <th scope="col">accountAlpha</th>
            <th scope="col">accountKanji</th>
            <th scope="col">Watch</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(account, index) in accounts" :key="index">
            <th scope="row">{{ account.id }}</th>
            <td>{{ account.accountAlpha }}</td>
            <td>{{ account.accountKanji }}</td>
            <td>
              <router-link v-bind:to="{name: 'account.detail', params: { accountId: account.id } }">
                <button class="btn btn-primary">Watch</button>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.account'}">
        <button class="btn btn-success mt-5" style="width:190px">勘定科目ノ部メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      accounts: [],
      loading: true,
    };
  },
  methods: {
    getAccountsData() {
      axios.get("/api/account/all/").then((res) => {
        this.accounts = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getAccountsData();
  },
};
</script>
