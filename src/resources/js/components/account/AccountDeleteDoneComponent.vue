<template>
  <div class="container">
    <h2>勘定科目明細削除完了 id : {{ accountId }}</h2>
    <router-link v-bind:to="{name: 'saisan.account'}">
      <button class="btn btn-success mt-5" style="width:190px">勘定科目ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  props: {
    accountId: Number,
  },
};
</script>
