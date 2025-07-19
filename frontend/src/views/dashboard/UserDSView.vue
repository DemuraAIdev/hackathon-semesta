<script setup lang="ts">
import HeaderDash from "@/components/HeaderDash.vue";
import { useAuthStore } from "@/stores/auth";
const user = useAuthStore();
</script>

<template>
  <HeaderDash />
  <main>You are : {{ user.role[0] }}</main>
</template>
