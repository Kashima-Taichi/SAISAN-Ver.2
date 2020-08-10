<template>
  <div class="container">
    <div v-show="loading" class="loader"></div>
    <div v-show="!loading">
      <h3>勘定科目登録完了</h3>
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
            <th scope="row">{{ accont.id }}</th>
            <td>{{ accont.accountAlpha }}</td>
            <td>{{ accont.accountKanji }}</td>
          </tr>
        </tbody>
      </table>
      <router-link v-bind:to="{name: 'saisan.account'}">
        <button class="btn btn-success mt-5">勘定科目のメニューへ</button>
      </router-link>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      accont: {},
      loading: true,
    };
  },
  methods: {
    getLatestAccountData() {
      axios.get("/api/account/latest/").then((res) => {
        this.accont = res.data;
        this.loading = false;
      });
    },
  },
  mounted() {
    this.getLatestAccountData();
  },
};
</script>
