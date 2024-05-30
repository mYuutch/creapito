<script setup>
import { defineProps } from 'vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  product: {
    type: Array,
    default: () => []
  },
});

function addToCart(product) {

const cartItem = {
  product_id: product.id,
  quantity: 1
};

router.post('cart/add', cartItem);

}
</script>

<template>
    <AppLayout>
        <div class="flex max-w-7xl mx-auto p-12">
            <h1 class="">{{ product.name }}</h1>
        </div>
</AppLayout>
</template>
