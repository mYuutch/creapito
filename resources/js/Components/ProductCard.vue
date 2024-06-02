<template>
  <div class="flex flex-col font-neulis">
    <div class="w-full overflow-hidden  mb-4 aspect-square bg-slate-300">
      
      <img v-if="product.image_url" class="h-full w-full object-cover" :src="fullImage(product.image_url)"  alt="Product Image">
    </div>
    <Link :href="getProductLink(product)" class="mb-1 font-medium truncate hover:underline">{{ product.name }}</Link>
    <p class="mb-4">{{ product.price }}€</p>
    <button @click="addToCart(product)" class="bg-[#C3A181] rounded-xl px-4 h-12 py-2 w-full xl:w-1/2 text-sm self-end text-white">Ajouter au panier</button>
  </div>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3';

const props = defineProps({
  product: {
    type: Object,
    required: true
  },
  isInSlider: {
    type: Boolean,
    default: false
  }
});

const getProductLink = (product) => {
  return `/products/${product.id}`;
};

const fullImage = (link) => {
  const fullUrl = `/storage/${link}`;
  console.log('Constructed full image URL:', fullUrl);
  return fullUrl;
};

const addToCart = (product) => {
  const cartItem = {
    product_id: product.id,
    quantity: 1
  };
  
  // Use router.post to make a POST request to the cart/add endpoint
  router.post('/cart/add', cartItem);
};
</script>
