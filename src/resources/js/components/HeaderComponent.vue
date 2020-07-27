<template>
  <div class="container-fluid bg-dark mb-3">
    <div class="container">
      <nav class="navbar navbar-dark">
        <span class="navbar-brand mb-0 h1">SAISAN Ver.2</span>
        <div>
          <button class="btn btn-success">TOP</button>
          <router-link v-bind:to="{name: 'saisan.menus'}">
            <button class="btn btn-success">Menu</button>
          </router-link>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {};
</script>
