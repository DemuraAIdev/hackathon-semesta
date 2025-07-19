<script setup lang="ts">
import api from "@/api";
import { onMounted, ref } from "vue";
import { RouterLink } from "vue-router";
// import moment from 'moment';

interface Report {
  id: number;
  location: string;
  photo_path: string;
  selfi_path: string;
  status: string;
  type: string;
  created_at: Date;
}

const reports = ref<Report[]>([]);

onMounted(async () => {
  const res = await api.get("/assignment/user");
  if (res.status === 200) {
    console.log(res.data);
    reports.value = res.data.data;
  }
});
</script>

<template>
  <main>
    <div>
      <div class="flex justify-between">
        <h1 class="text-2xl">My Assignment</h1>
      </div>

      <table class="table-auto overflow-auto w-full content-between text-center">
        <thead>
          <tr>
            <th style="height: 50px">No</th>
            <th>Date</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(report, idx) in reports" :key="idx">
            <td>{{ idx }}</td>
            <td>{{ report.created_at }}</td>
            <td>
              <RouterLink class="bg-black text-white p-3" :to="`/report/${report.id}`"
                >Detail</RouterLink
              >
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>
