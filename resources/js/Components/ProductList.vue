<template>
    <div class="grid grid-cols-2 md:grid-cols-3  max-w-7xl mx-auto gap-8  px-4 sm:px-6 lg:px-8 relative">
       <Product :product="product" v-for="product in products" :key="product.id" />
    </div>

  </template>
  
  <script>
  import Product from './ProductCard.vue';
  import Pagination from './Pagination.vue';
  
  export default {
    components: {
      Product,
      Pagination
    },
    props: {
      products: {
        type: Array,
        required: true
      },

      links: {
        type: Array
      }
    }
  }
  </script>
  