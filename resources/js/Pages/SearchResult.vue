<template>
    <AppLayout title="Products">
      <div>
        <ProductList v-if="products" :products="products"/>
      
     
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import ProductList from '../Components/ProductList.vue';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import FilterBadge from '../Components/FilterBadge.vue';
  import Pagination from '@/Components/Pagination.vue';
  
  const props = defineProps({
    products: {
      type: Array,
      required: true,
    },
    types: {
      type: Array,
      required: true,
    },
  });
  

  </script>
  