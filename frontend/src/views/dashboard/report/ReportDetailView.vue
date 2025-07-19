<script setup lang="ts">
import api from "@/api";
import { onMounted, ref } from "vue";
import { RouterLink, useRoute } from "vue-router";
import moment from "moment";
import { useAuthStore } from "@/stores/auth";
// import moment from 'moment';

interface Report {
  id: number;
  location: string;
  photo_path: string;
  selfi_path: string;
  status: string;
  type: string;
  description: string;
  created_at: Date;
}

const router = useRoute();
const report = ref<Report>();
const user = useAuthStore();

async function handleCloseReport() {
  const res = await api.post(`/report/close/${router.params.id}`, {
    close: "closed",
  });
  if (res.status !== 200) {
    return console.log(res.data.message);
  }
  return location.reload();
}

onMounted(async () => {
  const res = await api.get(`/report/${router.params.id}`);
  if (res.status !== 200) {
    return console.log(res.data.message);
  }
  report.value = res.data.data;
  console.log(res.data);
});
</script>

<template>
  <main>
    <div>
      <div class="flex justify-between">
        <h1 class="text-2xl">{{ moment(report?.created_at, "HH:mm:ss").format("dddd D-M-Y") }}</h1>

        <RouterLink
          v-if="user.role.includes('residents')"
          class="bg-black px-3 py-2 text-white"
          to="/report"
          >Back</RouterLink
        >
        <RouterLink v-else class="bg-black px-3 py-2 text-white" to="/assignment">Back</RouterLink>
      </div>
      <div class="grid md:grid-cols-4 sm:grid-cols-1 border-2 mb-3">
        <p>{{ report?.description }}</p>
        <div>Location : {{ report?.location }}</div>
        <div></div>
        <div class="relative">
          <p class="right-0 text-2xl top-0 font-bold">Status : {{ report?.status }}</p>
        </div>
      </div>
      <div class="grid md:grid-cols-2 sm:grid-cols-1">
        <div class="mr-4">
          <p>Photo Attachment</p>
          <img class="w-full" :src="report?.photo_path" alt="" />
        </div>
        <div>
          <p>Selfie Attachment</p>
          <img class="w-50" :src="report?.selfi_path" alt="" />
        </div>
      </div>
    </div>
    <button
      @click="handleCloseReport"
      class="bg-black text-white p-3 mt-5"
      v-if="!user.role.includes('residents') && report?.status !== 'closed'"
    >
      Close Report
    </button>
  </main>
</template>
