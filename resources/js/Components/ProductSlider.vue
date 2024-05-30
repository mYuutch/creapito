<template>
    <div class="max-w-7xl w-full mx-auto flex gap-8 px-4 sm:px-6 lg:px-8 py-8 overflow-x-scroll">
        <div v-for="product in products" class="w-92">
            <Product :product="product" :isInSlider="true"  :key="product.id" />
        </div>
      
    </div>
  </template>
  
  <script>
  import Product from './ProductCard.vue';
  
  export default {
    components: {
      Product
    },
    props: {
      products: {
        type: Array,
        required: true
      }
    }
  }
  </script>