<script setup>
import { defineProps } from 'vue';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { parseISO, format, addHours } from 'date-fns';

defineProps({
  order: {
    type: Object,
    default: () => []
  },
});

const formatDateToParisTime = (dateString) => {
  // Parse the ISO string to a Date object
  const date = parseISO(dateString);

  // Manually add 2 hours to convert to Paris time (UTC+2)
  // Note: This does not account for daylight saving time
  const parisDate = addHours(date, 2);

  // Format the date in the desired format
  return format(parisDate, 'dd/MM/yyyy à HH:mm');
};

</script>

<template>
    <AppLayout>
        <div class="flex max-w-7xl mx-auto py-12">
            <h1 class="">Votre Commande</h1>
        </div>
        
    <div class="max-w-7xl mx-auto flex flex-col  min-h-[50vh] py-12 gap-24">

        <div>
            <p>Date : {{ formatDateToParisTime(order.created_at) }}</p>

            <p>Paiement : 
                <span v-if="order.payment_status == 'unpaid'"> Non payé</span>
                <span v-if="order.payment_status == 'paid'"> Payé</span>
            </p>

            <p>Livraison : 
                <span v-if="order.shipping_status == 'pending'"> En attente de livraison</span>
                <span v-if="order.shipping_status == 'shipping'"> En cours de livraison</span>
                <span v-if="order.shipping_status == 'delivered'"> Livré </span>
            </p>

            <p>
                Addresse de livraison : 
                <span>{{ order.shipping_address }}</span>
                
            </p>

            <p v-if="order.link"> Lien de suivi :
                <span>{{ order.link }}</span>
            </p>

        </div>

        <div class="flex flex-col w-full gap-8">
        <div v-for="item in order.items" class="flex items-center justify-between">
            {{ console.log(item.product) }}
            <div class="flex items-center gap-8">
                    <div class="h-24 w-24 bg-slate-300">
                    <img class="object-cover h-full" :src="'/storage/' + item.product.image_url" alt="">
                </div>
                <div class="flex flex-col">
                <p>{{ item.product.name }}</p>
                <p>{{ item.product.price.toFixed(2)}} €</p>
                </div>

                </div>
                
                
                <div>
                    <p>Qté. {{ item.quantity }}</p>
                </div>

        </div>
    </div>

    <div class="flex justify-between">
        <p>Total :</p>
        <p>{{ order.total_amount.toFixed(2) }} €</p>
    </div>
    </div>
</AppLayout>
</template>
