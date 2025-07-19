<script setup lang="ts">
import { RouterLink, RouterView, useRouter } from "vue-router";
import { useAuthStore } from "./stores/auth";

const user = useAuthStore();
const router = useRouter();

async function logout() {
  user.logout();
  localStorage.removeItem("auth_token");
  router.push("/login");
}
</script>

<template>
  <header class="flex justify-between p-5 shadow-md mb-5">
    <h1 class="text-3xl font-bold">ApartemenKu!</h1>
    <div class="wrapper">
      <nav class="">
        <RouterLink class="mr-3" to="/">Home</RouterLink>
        <RouterLink class="mr-3" v-if="!user.isAuthenticated" to="/login">Login</RouterLink>
        <RouterLink class="mr-3" v-else to="/dashboard">Dashboard</RouterLink>
        <button v-if="user.isAuthenticated" @click="logout">Logout</button>
      </nav>
    </div>
  </header>
  <div class="mx-5">
    <RouterView />
  </div>
</template>
