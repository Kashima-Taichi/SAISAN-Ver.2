<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <form v-on:submit.prevent="submit">
            <div class="form-group row">
              <label for="year" class="col-sm-3 col-form-label">Year</label>
              <input type="text" class="col-sm-9 form-control" id="year" v-model="cost.year" />
            </div>
            <div class="form-group row">
              <label for="month" class="col-sm-3 col-form-label">Month</label>
              <input type="text" class="col-sm-9 form-control" id="month" v-model="cost.month" />
            </div>
            <div class="form-group row">
              <label for="day" class="col-sm-3 col-form-label">Day</label>
              <input type="text" class="col-sm-9 form-control" id="day" v-model="cost.day" />
            </div>
            <div class="form-group row">
              <label for="account-name" class="col-sm-3 col-form-label">Account</label>
              <select class="col-sm-9 form-control" id="account" v-model="cost.accountName">
                <option
                  v-for="(account, index) in accounts"
                  :key="index"
                  v-bind:value="account.accountKanji"
                >{{ account.accountKanji }}</option>
              </select>
            </div>
            <div class="form-group row mb-5">
              <label for="dependency" class="col-sm-3 col-form-label">Dependency</label>
              <select class="col-sm-9 form-control" id="dependency" v-model="cost.dependency">
                <option value="0">independent</option>
                <option value="1">dependent</option>
              </select>
            </div>
            <div class="form-group row">
              <label for="price" class="col-sm-3 col-form-label">Price</label>
              <input type="text" class="col-sm-9 form-control" id="price" v-model="cost.price" />
            </div>
            <div class="form-group row">
              <label for="journal" class="col-sm-3 col-form-label">Journal</label>
              <input type="text" class="col-sm-9 form-control" id="journal" v-model="cost.journal" />
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
    costId: Number,
  },
  data: function () {
    return {
      cost: {},
      accounts: [],
      loading: true,
    };
  },
  methods: {
    submit() {
      axios.put("/api/cost/edit/", this.cost).then((res) => {
        this.$router.push({ name: "cost.edit-done" });
      });
    },
    getCostIndividualData() {
      axios.get("/api/cost/detail/" + this.costId + "/").then((res) => {
        this.cost = res.data;
        this.loading = false;
      });
    },
    getAccountList() {
      axios.get("/api/account/list/").then((res) => {
        this.accounts = res.data;
      });
    },
  },
  mounted() {
    this.getAccountList();
    this.getCostIndividualData();
  },
};
</script>
