<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <h2>id : {{ account.id }}の勘定科目明細の修正</h2>
          <form v-on:submit.prevent="submit">
            <div class="form-group row">
              <label for="account-alpha" class="col-sm-3 col-form-label">account Alpha</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="account-alpha"
                v-model="account.accountAlpha"
              />
            </div>
            <div class="form-group row">
              <label for="account-kanji" class="col-sm-3 col-form-label">account Kanji</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="account-kanji"
                v-model="account.accountKanji"
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
    accountId: String,
  },
  data: function () {
    return {
      account: {},
      loading: true,
    };
  },
  methods: {
    submit() {
      axios.put("/api/account/edit/", this.account).then((res) => {
        this.$router.push({ name: "account.edit-done" });
      });
    },
    getAccountIndividualData() {
      axios.get("/api/account/detail/" + this.accountId + "/").then((res) => {
        this.account = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getAccountIndividualData();
  },
};
</script>
