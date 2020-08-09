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
          <th scope="row">賞与参照</th>
          <td>
            <router-link v-bind:to="{name: 'bonus.list.selecty'}">
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
