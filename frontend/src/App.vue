<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { useAuthStore } from './stores/auth';

const user = useAuthStore()
</script>

<template>
  <header class="flex justify-between p-5">
    <h1 class="text-3xl font-bold">ApartemenKu!</h1>
    <div class="wrapper">
      <nav>
        <RouterLink class="mr-3" to="/">Home</RouterLink>
        <RouterLink class="mr-3" v-if="!user.isAuthenticated" to="/login">Login</RouterLink>
        <RouterLink class="mr-3" v-else to="/dashboard">Dashboard</RouterLink>
         <RouterLink v-if="user.isAuthenticated" to="/login">Logout</RouterLink>
      </nav>
    </div>
  </header>
  <div class="mx-5">
  <RouterView />
  </div>
</template>
