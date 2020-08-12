<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">id</th>
          <th scope="col">accountAlpha</th>
          <th scope="col">accountKanji</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">{{ account.id }}</th>
          <td>{{ account.accountAlpha }}</td>
          <td>{{ account.accountKanji }}</td>
          <td>
            <router-link v-bind:to="{name: 'account.edit', params: { accountId: account.id } }">
              <button class="btn btn-success">Edit</button>
            </router-link>
          </td>
          <td>
            <button v-on:click="deleteAccount(account.id)" class="btn btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
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
    };
  },
  methods: {
    deleteAccount(id) {
      axios.delete("/api/account/delete/" + id + "/").then((res) => {
        this.$router.push({ name: "account.delete-done" });
      });
    },
    getAccountIndividualData() {
      axios.get("/api/account/detail/" + this.accountId + "/").then((res) => {
        this.account = res.data;
      });
    },
  },
  mounted() {
    this.getAccountIndividualData();
  },
};
</script>
