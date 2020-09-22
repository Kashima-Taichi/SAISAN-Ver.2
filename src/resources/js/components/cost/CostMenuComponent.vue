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
          <th scope="row">経費を計上</th>
          <td>
            <router-link v-bind:to="{name: 'cost.rec'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">個人支出の経費を参照(月次・日次)</th>
          <td>
            <router-link v-bind:to="{name: 'cost.list.selectym'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">依存経費を参照(月次)</th>
          <td>
            <router-link v-bind:to="{name: 'cost.dependent.selectym'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">事業経費を参照(月次)</th>
          <td>
            <router-link v-bind:to="{name: 'cost.business.selectym'}">
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
