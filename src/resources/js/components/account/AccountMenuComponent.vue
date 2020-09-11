<template>
  <div class="container">
    <table class="table table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="col">コンテンツ</th>
          <th scope="col">アクション</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">勘定科目を登録</th>
          <td>
            <router-link v-bind:to="{name: 'account.rec'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">勘定科目を参照</th>
          <td>
            <router-link v-bind:to="{name: 'account.list'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {};
</script>
