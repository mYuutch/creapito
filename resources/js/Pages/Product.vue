<script setup>
import { defineProps } from 'vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  product: {
    type: Object,
    default: () => []
  },
});

function addToCart(product) {

const cartItem = {
  product_id: product.id,
  quantity: 1
};

router.post('/cart/add', cartItem);

}
</script>

<template>
    <AppLayout>
        <div class="flex flex-col lg:flex-row max-w-7xl mx-auto p-12 gap-8 items-center justify-center">
          <div class=" w-full lg:w-1/2 mb-12 lg:mb-0">
            <img v-if="product.image_url" class="w-full object-cover" :src=" '/storage/' + product.image_url"  alt="Product Image">
          </div>
          
          <div class=" w-full lg:w-1/2 flex flex-col mb-24 lg:mb-0">
            <h1 class=" font-neulis text-2xl mb-2 font-medium">{{ product.name }}</h1>
            <p class="text-xl mb-4">{{ product.price.toFixed(2) }} €</p>
            <p class="opacity-60 mb-8">{{ product.description }}</p>
            <button @click="addToCart(product)" class="bg-[#C3A181] rounded-xl self-end px-4 h-12 py-2 w-full xl:w-1/2 text-sm text-white">Ajouter au panier</button>
          </div>
            
        </div>
</AppLayout>
</template>
