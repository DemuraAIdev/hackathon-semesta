<script setup lang="ts">
import api from "@/api";
import { onMounted, ref } from "vue";
import { RouterLink } from "vue-router";
// import moment from 'moment';

interface Location {
  id: number;
  address: string;
}

const description = ref("");
const type = ref("");
const selfi_path = ref("");
const photo_path = ref("");
const location = ref("");
const message = ref("");

async function handleFilePhotoChange(event: any) {
  photo_path.value = event.target.files[0];
}

async function handleFileSelfieChange(event: any) {
  selfi_path.value = event.target.files[0];
}

async function handleCreate() {
  const res = await api.post("/report", {
    description: description.value,
    type: type.value,
    selfi_path: selfi_path.value,
    photo_path: photo_path.value,
    location: location.value,
  });

  if (res.status !== 200) {
    console.log(res.data.message);
    message.value = res.data.message;
  }
}

const listLocation = ref<Location[]>([]);

onMounted(async () => {
  const res = await api.get("/location/user");
  listLocation.value = res.data.data;
});
</script>

<template>
  <main>
    <div>
      <div class="flex justify-between">
        <h1 class="text-2xl">Create Report</h1>

        <RouterLink class="bg-black px-3 py-2 text-white" to="/report">Back</RouterLink>
      </div>
      <div>
        <form @submit.prevent="handleCreate" class="flex flex-col">
          <label for="description"> Description :</label>
          <textarea
            placeholder="Insert description report"
            class="border-2 border-black mb-2"
            v-model="description"
          >
Isi</textarea
          >
          <label for="type">Type Report</label>
          <select class="border-2 border-black" v-model="type">
            <option value="Isi" disabled selected>Isi</option>
            <option value="plumber">Plumber</option>
            <option value="electricity">Electricity</option>
            <option value="cleaning">Cleaning</option>
            <option value="security">Security</option>
          </select>
          <label for="location">Location Report</label>
          <select class="border-2 border-black" v-model="location">
            <option value="Isi" disabled selected>Isi</option>
            <option v-for="(location, idx) in listLocation" :value="location.address" :key="idx">
              {{ location.address }}
            </option>
          </select>
          <label for="Photo Report">Photo :</label>
          <input
            @change="handleFilePhotoChange"
            type="file"
            id="picture"
            name="picture"
            accept="image/*"
            capture="environment"
          />

          <label for="Photo Report">Selfie :</label>
          <input
            @change="handleFileSelfieChange"
            type="file"
            id="picture"
            name="picture"
            accept="image/*"
            capture="user"
          />

          <button class="bg-black py-3 mt-2 text-white" type="submit">Create</button>
        </form>
      </div>
    </div>
  </main>
</template>
