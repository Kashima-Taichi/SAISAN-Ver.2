<template>
  <div class="container">
    <h2>稼働時間明細削除完了 id : {{ hourId }}</h2>
    <router-link v-bind:to="{name: 'saisan.hour'}">
      <button class="btn btn-success mt-5" style="width:170px">時間ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  props: {
    hourId: Number,
  },
};
</script>
