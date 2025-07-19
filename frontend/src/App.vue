<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'

</script>

<template>
  <header class="flex justify-between p-5">
    <h1 class="text-3xl font-bold">ApartemenKu!</h1>
    <div class="wrapper">
      <nav>
        <RouterLink class="mr-3" to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header>
  <RouterView />
</template>
