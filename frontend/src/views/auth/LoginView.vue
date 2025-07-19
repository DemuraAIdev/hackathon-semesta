<script setup lang="ts">
import api from '@/api';
import { useAuthStore } from '@/stores/auth';
import { ref } from 'vue';
import { useRouter } from 'vue-router';


const email = ref('')
const password = ref('')
const message = ref('')
const user = useAuthStore()
const router = useRouter()

async function handleLogin()  {
  const res = await api.post('/login', {
    "email": email.value,
    "password": password.value
  })

  if (res.status !== 200) {
    console.log(res.data.message)
    return message.value = res.data.message
  }
  user.token = res.data.token
  localStorage.setItem('auth_token', res.data.token)

  message.value = res.data.message
  return router.push('/dashboard')
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
