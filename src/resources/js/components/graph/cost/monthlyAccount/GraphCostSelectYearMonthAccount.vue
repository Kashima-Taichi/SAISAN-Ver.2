<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <form v-on:submit.prevent="submit">
        <div class="form-group">
          <label for="account-name" class="col-sm-3 col-form-label">Account</label>
          <select class="col-sm-9 form-control" id="account" v-model="account">
            <option
              v-for="(account, index) in accounts"
              :key="index"
              v-bind:value="account.accountAlpha"
            >{{ account.accountKanji }}</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      // formで使用するデータ
      accounts: [],
      // formから送信するデータ
      account: "",
      loading: true,
    };
  },
  methods: {
    // 年月の情報を取得
    getCostAccount() {
      axios.get("/api/account/list/").then((res) => {
        this.accounts = res.data;
        this.loading = false;
      });
    },
    submit() {
      this.$router.push({
        name: "graph.cost.monthly-account",
        params: { account: this.account },
      });
    },
  },
  mounted() {
    this.getCostAccount();
  },
};
</script>
