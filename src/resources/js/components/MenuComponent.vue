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
          <th scope="row">支出ノ部</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.cost'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">収入ノ部</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.salary'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">賞与ノ部</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.bonus'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">時間ノ部</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.hour'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">勘定科目ノ部</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.account'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">その他ノ部</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.other'}">
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
