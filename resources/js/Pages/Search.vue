<template>
    <AppLayout title="Search">

        <form @submit.prevent="submit">
    <label for="name">Date:</label>
    <input type="name" id="name" v-model="form.name"  />

    <button type="submit">Search</button>
  </form>
      
    </AppLayout>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { router } from '@inertiajs/vue3';

  const form = ref({
  name: null
})

function submit() {
  console.log(form.value);
  router.post(route('products.search'), form.value);
}



  </script>
  