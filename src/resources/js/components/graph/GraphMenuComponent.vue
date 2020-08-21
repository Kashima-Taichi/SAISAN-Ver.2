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
            <router-link v-bind:to="{name: 'graph.graph.cost.daily-amount-select'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">経費計上日別合計金額推移(複数月)</th>
          <td>
            <router-link v-bind:to="{name: 'graph.graph.cost.daily-amounts-select'}">
              <button class="btn btn-primary">GO!</button>
            </router-link>
          </td>
        </tr>
        <tr>
          <th scope="row">経費計上金額日別推移</th>
          <td>
            <router-link v-bind:to="{name: 'graph.graph.cost.daily-select'}">
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
