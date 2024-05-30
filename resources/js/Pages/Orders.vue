<script setup>
import { defineProps } from 'vue';
import { parseISO, format, addHours } from 'date-fns';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
  orders: {
    type: Array, // changed from Object to Array
    default: () => []
  },
});

const formatDateToParisTime = (dateString) => {
  // Parse the ISO string to a Date object
  const date = parseISO(dateString);

  // Manually add 2 hours to convert to Paris time (UTC+2)
  // Note: This does not account for daylight saving time
  const parisDate = addHours(date, 0);

  // Format the date in the desired format
  return format(parisDate, 'dd/MM/yyyy à HH:mm');
};

function getLink(order){
return "/orders/" + order.id
}

</script>

<template>
    <AppLayout>
        <div class="max-w-7xl mx-auto py-24">
            <table class="w-full mx-auto bg-white">
            <thead>
                <tr>
                    <th class="py-2">Date</th>
                    <th class="py-2">Total </th>
                    <th class="py-2">Paiement</th>
                    <th class="py-2">Livraison</th>
                    <th class="py-2">Accès</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in orders" :key="order.id">
                    <td class="border px-4 py-2">{{ formatDateToParisTime(order.created_at) }}</td>
                    <td class="border px-4 py-2">{{ order.total_amount.toFixed(2) }} €</td>
                    <td class="border px-4 py-2">
                        <span v-if="order.payment_status == 'unpaid'">Non payé</span>
                        <span v-if="order.payment_status == 'paid'">Payé</span>
                    </td>
                    <td class="border px-4 py-2">
                        <span v-if="order.shipping_status == 'pending'">En attente</span>
                        <span v-if="order.shipping_status == 'shipping'">En cours de livraison</span>
                        <span v-if="order.shipping_status == 'delivered'">Livré</span>
                    </td>
                    <td class="flex items-center justify-center">
                        <Link :href="getLink(order)" class="px-4 py-2 bg-[#C3A181] text-white rounded">Voir</Link>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
        
    </AppLayout>
</template>
