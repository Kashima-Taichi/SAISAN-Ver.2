<template>
  <div class="container">
    <h2>経費明細削除完了 id : {{ costId }}</h2>
    <router-link v-bind:to="{name: 'saisan.cost'}">
      <button class="btn btn-success mt-5" style="width:170px">経費ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  props: {
    costId: String,
  },
};
</script>
