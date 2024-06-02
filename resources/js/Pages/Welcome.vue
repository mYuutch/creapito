<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductCard from '@/Components/ProductCard.vue';
import InvertedProductCard from '@/Components/InvertedProductCard.vue'


defineProps({
    products: {
        type: Object,
    },
    latest: {
        type: Object,
    },
});

const web3FormsScript = 'https://web3forms.com/client/script.js';

// Initialize Web3Forms
const initializeWeb3Forms = () => {
    // Check if the script has already been loaded
    if (!document.querySelector(`script[src="${web3FormsScript}"]`)) {
        const script = document.createElement('script');
        script.src = web3FormsScript;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
};

initializeWeb3Forms();
</script>

<template>
    <AppLayout>
 
        <div class="w-full h-screen flex items-center justify-center">
            <h1 class="font-neulis font-medium text-[#C3A181] text-xl sm:text-3xl lg:text-5xl xl:text-6xl">Créapito : Créez, Colorez, Enchantez!</h1>
        </div>

        <div class="w-full mb-80">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl text-[#C3A181] font-neulis font-medium p-12" >Les nouveautés</h2>
            </div>
            
            <div class="w-1/2 sm:w-1/3 border-t-4 border-[#C3A181]"></div>
            
            <div class="max-w-7xl flex flex-col md:flex-row mx-auto gap-8 p-12">
            <ProductCard  v-for="product in latest" :product="product"class="w-1/3"/>
        </div>
        <div class="w-1/2 sm:w-1/3 border-t-4 ml-auto border-[#C3A181]"></div>

        </div>

        <div class="w-full bg-[#C3A181]  my-24 xl:rounded-b-[10%] shadow-xl p-12 md:p-24 flex flex-col items-center">

            <h2 class="mx-auto p-4 border-b-2 border-white text-2xl sm:px-12 mb-12 font-neulis text-white font-medium">Les best-seller</h2>

            <div class="max-w-7xl mx-auto ">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-16  max-w-7xl mx-auto gap-8  sm:px-6 lg:px-8 relative">
                    <InvertedProductCard :product="product" v-for="product in products" :key="product.id" />
                </div>
            </div>

            <Link :href="route('products')" class="bg-white px-8 py-2 rounded mt-24 mb-24 font-neulis text-[#C3A181]">Voir tout les produits</Link>
        </div>

    <div class="w-full mb-80">

        <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl text-[#C3A181] font-neulis font-medium p-12" >Me contacter</h2>
            </div>
            
            <div class=" w-1/2 sm:w-1/3 border-t-4 border-[#C3A181]"></div>

        
        <div class="max-w-4xl mx-auto py-32">

            <form class="flex flex-col gap-8 p-12 " action="https://api.web3forms.com/submit" method="POST">

<!-- Replace with your Access Key -->
<input type="hidden" name="access_key" value="235f9180-0af4-4aff-a700-6092d8f4dd41">
<input type="hidden" name="redirect" value="https://creapito.enzobouchez.fr">

<div class="flex flex-col lg:flex-row gap-8 justify-between">    
    <div class="flex flex-col w-full lg:w-1/2">
        <label class="font-neulis font-medium text-[#C3A181] mb-4">Nom :</label>
<input class="w-full rounded bg-[#C3A181] bg-opacity-20 border-none" type="text" name="name" required>

    </div>

    <div class="flex flex-col w-full lg:w-1/2">
        <label class="font-neulis font-medium text-[#C3A181] mb-4" for="email">E-Mail :</label>
        <input class="w-full rounded bg-[#C3A181] bg-opacity-20 border-none" type="email" name="email" required>
    </div>

</div>

<div>
    <label class="flex flex-col w-full font-neulis font-medium text-[#C3A181] mb-4">Votre Message :</label>
    <textarea class="resize-none rounded w-full bg-[#C3A181] bg-opacity-20 border-none" name="message" required></textarea>
</div>



<div class="h-captcha" data-lang="fr" data-captcha="true"></div>

<button class="self-end bg-[#C3A181] px-8 py-2 rounded text-white font-neulis" type="submit">Envoyer</button>

</form>
<!-- Required for hCaptcha -->

        </div>

        <div class="w-1/3 border-t-4 ml-auto border-[#C3A181]"></div>
    </div>
        

</AppLayout>
</template>
