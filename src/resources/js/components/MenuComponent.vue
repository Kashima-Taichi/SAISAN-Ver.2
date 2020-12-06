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
          <th scope="row">経費関係</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.cost'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">所得関係</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.salary'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">賞与関係</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.bonus'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">稼働時間関係</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.hour'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">勘定科目関係</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.account'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">PL参照</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.pl'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">グラフ参照</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.graph'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">その他</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.other'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">資産管理</th>
          <td>
            <router-link v-bind:to="{name: 'saisan.asset'}">
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
