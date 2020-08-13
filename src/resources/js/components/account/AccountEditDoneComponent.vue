<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h2>勘定科目明細修正完了</h2>
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
      <router-link v-bind:to="{name: 'saisan.account'}">
        <button class="btn btn-success mt-5" style="width:190px">勘定科目ノ部メニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    accountId: Number,
  },
  data: function () {
    return {
      account: {},
      loading: true,
    };
  },
  methods: {
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
