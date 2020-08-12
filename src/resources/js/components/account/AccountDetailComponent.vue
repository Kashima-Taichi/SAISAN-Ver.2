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
        <tr>
          <th scope="row">{{ account.id }}</th>
          <td>{{ account.accountAlpha }}</td>
          <td>{{ account.accountKanji }}</td>
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
