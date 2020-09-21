<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <div class="row justify-content-center">
        <div class="col-sm-6">
          <form v-on:submit.prevent="submit">
            <validation-provider rules="required" v-slot="{ errors }">
              <div class="form-group row mb-5 mt-5">
                <label for="year" class="col-sm-3 col-form-label">Year</label>
                <input type="text" class="col-sm-9 form-control" id="year" v-model="cost.year" />
                <span class="mt-2 txt-tm">{{ errors[0] }}</span>
              </div>
            </validation-provider>

            <validation-provider rules="required" v-slot="{ errors }">
              <div class="form-group row mb-5">
                <label for="month" class="col-sm-3 col-form-label">Month</label>
                <input type="text" class="col-sm-9 form-control" id="month" v-model="cost.month" />
                <span class="mt-2 txt-tm">{{ errors[0] }}</span>
              </div>
            </validation-provider>

            <validation-provider rules="required" v-slot="{ errors }">
              <div class="form-group row mb-5">
                <label for="day" class="col-sm-3 col-form-label">Day</label>
                <input type="text" class="col-sm-9 form-control" id="day" v-model="cost.day" />
                <span class="mt-2 txt-tm">{{ errors[0] }}</span>
              </div>
            </validation-provider>

            <div class="form-group row mb-5">
              <label for="account-name" class="col-sm-3 col-form-label">Account</label>
              <select class="col-sm-9 form-control" id="account" v-model="cost.accountName">
                <option
                  v-for="(account, index) in accounts"
                  :key="index"
                  v-bind:value="account.accountKanji"
                >{{ account.accountKanji }}</option>
              </select>
            </div>

            <validation-provider rules="required" v-slot="{ errors }">
              <div class="form-group row mb-5">
                <label for="price" class="col-sm-3 col-form-label">Price</label>
                <input type="text" class="col-sm-9 form-control" id="price" v-model="cost.price" />
                <span class="mt-2 txt-tm">{{ errors[0] }}</span>
              </div>
            </validation-provider>

            <div class="form-group row mb-5">
              <label for="dependency" class="col-sm-3 col-form-label">Dependency</label>
              <select class="col-sm-9 form-control" id="dependency" v-model="cost.dependency">
                <option value="0">independent</option>
                <option value="1">dependent</option>
              </select>
            </div>

            <div class="form-group row mb-5">
              <label for="business" class="col-sm-3 col-form-label">Business Flag</label>
              <select class="col-sm-9 form-control" id="business" v-model="cost.business">
                <option value="0">事業に関係なし</option>
                <option value="1">事業に関係あり</option>
              </select>
            </div>

            <validation-provider rules="required" v-slot="{ errors }">
              <div class="form-group row mb-5">
                <label for="journal" class="col-sm-3 col-form-label">Journal</label>
                <input
                  type="text"
                  class="col-sm-9 form-control"
                  id="journal"
                  v-model="cost.journal"
                />
                <span class="mt-2 txt-tm">{{ errors[0] }}</span>
              </div>
            </validation-provider>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider, extend } from "vee-validate";
import { required } from "vee-validate/dist/rules";

extend("required", {
  ...required,
  message: "This field is required",
});

export default {
  data: function () {
    return {
      cost: {},
      accounts: [],
      loading: true,
    };
  },
  components: {
    ValidationProvider,
  },
  methods: {
    submit() {
      axios.post("/api/cost/store/", this.cost).then((res) => {
        this.$router.push({ name: "cost.rec-done" });
      });
    },
    fillDateInfo() {
      var now = new Date();
      this.cost.year = now.getFullYear();
      this.cost.month = now.getMonth() + 1;
      this.cost.day = now.getDate();
    },
    getAccountList() {
      axios.get("/api/account/list/").then((res) => {
        this.accounts = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getAccountList();
    this.fillDateInfo();
  },
};
</script>
