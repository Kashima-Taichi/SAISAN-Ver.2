<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
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
</template>
<script>
export default {
  data: function () {
    return {
      account: {},
    };
  },
  methods: {
    submit() {
      axios.post("/api/account/store/", this.account).then((res) => {
        this.$router.push({ name: "account.rec-done", props: this.accont });
      });
    },
  },
};
</script>
