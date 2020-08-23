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
          <th scope="row">経費計上日別合計金額推移(単月)</th>
          <td>
            <router-link v-bind:to="{name: 'graph.cost.daily-amount-select'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">経費計上日別合計金額推移(複数月)</th>
          <td>
            <router-link v-bind:to="{name: 'graph.cost.daily-amounts-select'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">経費計上金額日別推移</th>
          <td>
            <router-link v-bind:to="{name: 'graph.cost.daily-select'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">科目別月別経費計上金額推移</th>
          <td>
            <router-link v-bind:to="{name: 'graph.cost.monthly-account-select'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">給与総額・手取額(全期間)</th>
          <td>
            <router-link v-bind:to="{name: 'graph.salary.saving'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">月別利益(全期間)</th>
          <td>
            <router-link v-bind:to="{name: 'graph.salary.profit'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">経費計上円グラフ(月別)</th>
          <td>
            <router-link v-bind:to="{name: 'graph.donut.cost-select'}">
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
