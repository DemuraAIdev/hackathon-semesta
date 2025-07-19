<script setup lang="ts">
import api from '@/api';
import { ref } from 'vue';


const email = ref('')
const password = ref('')
const message = ref('')

async function handleLogin()  {
  const res = await api.post('/login', {
    "email": email.value,
    "password": password.value
  })

  if (res.status !== 200) {
    console.log(res.data.message)
    return message.value = res.data.message
  }
  return message.value = res.data.message
}
</script>

<template>
  <main>
    <form @submit.prevent="handleLogin" class="flex flex-col px-20">
      <input type="email" v-model="email">
      <input type="password" v-model="password">
      <button type="submit">Login</button>
    </form>
    <p class="text-red-600">{{ message }}</p>
  </main>
</template>
