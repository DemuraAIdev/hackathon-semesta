<script setup lang="ts">
import { useAuthStore } from "@/stores/auth";

const user = useAuthStore();
</script>

<template>
  <div class="flex bg-black text-white px-5 py-3 mb-3">
    <nav v-if="user.role.includes('residents')">
      <RouterLink class="mr-3" to="/report">Report</RouterLink>
      <RouterLink class="mr-3" to="/">Home</RouterLink>
    </nav>
    <nav v-else-if="user.role.includes('supervisor')">
      <RouterLink class="mr-3" to="/report">User Management</RouterLink>
      <RouterLink class="mr-3" to="/">Home</RouterLink>
    </nav>
    <nav v-else>
      <RouterLink class="mr-3" to="/assignment">Assignment</RouterLink>
      <RouterLink class="mr-3" to="/">Home</RouterLink>
    </nav>
  </div>
</template>
