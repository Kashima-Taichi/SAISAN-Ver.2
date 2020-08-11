<template>
  <div class="container">
    <h2>賞与明細削除完了 id : {{ bonusId }}</h2>
    <router-link v-bind:to="{name: 'saisan.bonus'}">
      <button class="btn btn-success mt-5" style="width:170px">賞与ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  props: {
    bonusId: Number,
  },
};
</script>
