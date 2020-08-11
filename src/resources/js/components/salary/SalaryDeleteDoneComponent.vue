<template>
  <div class="container">
    <h2>所得明細削除完了 id : {{ salaryId }}</h2>
    <router-link v-bind:to="{name: 'saisan.salary'}">
      <button class="btn btn-success mt-5" style="width:170px">所得ノ部メニューへ</button>
    </router-link>
  </div>
</template>
<script>
export default {
  props: {
    salaryId: String,
  },
};
</script>
