<script setup>
import { defineProps } from 'vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  cartItems: {
    type: Object,
    default: () => []
  },
});

function getTotal(items) {
  return items.reduce((total, item) => total + (item.product.price * item.quantity), 0);
}

function clearCart(){
    router.post('/cart/clear')
}

function checkout(){
    router.post('/test')
}

function addToCart(product) {

const cartItem = {
  product_id: product.id,
  quantity: 1
};

// Use router.post to make a POST request to the cart/add endpoint
router.post('cart/add', cartItem);

}


function removeFromCart(product){

    const cartItem = {
        product_id: product.id
    }

    router.post('cart/remove', cartItem);
}
</script>

<template>
    <AppLayout>
        <div class="flex max-w-7xl mx-auto p-12">
            <h1 class="">Votre Panier</h1>
        </div>
        
    <div class=" p-12 max-w-7xl mx-auto flex flex-col md:flex-row  min-h-[50vh] py-24 gap-24">
  
        <div class=" w-full md:w-1/2  flex flex-col gap-8 ">
            <div v-for="item in cartItems" class="flex items-center justify-between">

                <div class="flex items-center gap-8">
                    <div class="h-24 w-24 bg-slate-300">
                    <img class="object-cover h-full" :src="'/storage/' + item.product.image_url" alt="">
                </div>
                <div class="flex flex-col">
                    <p>{{ item.product.name }}</p>
                <p>{{ item.product.price}} €</p>
                </div>

                </div>
                
                
                <div>
                    <p>Qté. {{ item.quantity }}</p>
                </div>

                <button @click="removeFromCart(item.product)" class="text-white bg-[#C3A181] px-3 py-1 rounded">X</button>
            
            </div>
   
        </div>

        <div class="w-full md:w-1/2 flex flex-col p-8 border-2 justify-between rounded border-[#C3A181]">
            <p>Total</p>
            <p class="self-end">{{ getTotal(cartItems).toFixed(2) }} €</p>
            <p>Dont</p>
            <p class="self-end">TVA {{ (getTotal(cartItems) - getTotal(cartItems) / 1.2).toFixed(2) }}€</p>
            <button @click="checkout" class="px-4 py-2 bg-[#C3A181] text-white rounded mt-12">Commander</button>
        </div>

    </div>
</AppLayout>
</template>
