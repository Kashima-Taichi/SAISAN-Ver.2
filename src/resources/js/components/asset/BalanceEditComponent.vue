<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <form v-on:submit.prevent="submit">
            <div class="row">
              <label for="id" class="col-sm-3">id</label>
              <p class="col-sm-9">{{ balance.id }}</p>
            </div>
            <div class="form-group row">
              <label for="bank_id" class="col-sm-3 col-form-label">Bank_Id</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="bank_id"
                v-model="balance.bank_id"
              />
            </div>
            <div class="form-group row">
              <label for="bank_name" class="col-sm-3 col-form-label">Bank_Name</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="bank_name"
                v-model="balance.bank_name"
              />
            </div>
            <div class="form-group row">
              <label for="balance" class="col-sm-3 col-form-label">Balance</label>
              <input
                type="text"
                class="col-sm-9 form-control"
                id="balance"
                v-model="balance.balance"
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
    bankId: Number,
  },
  data: function () {
    return {
      balance: {},
      loading: true,
    };
  },
  methods: {
    submit() {
      axios.put("/api/bank/edit/", this.balance).then((res) => {
        this.$router.push({ name: "banks.edit-done" });
      });
    },
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
