<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ApplicationLogoWhite from '@/Components/ApplicationLogoWhite.vue';
import InstaLogo from '@/Components/InstaLogo.vue';
import TikTokLogo from '@/Components/TikTokLogo.vue';
import Navbar from '@/Components/Navbar.vue';
import SearchLogo from '@/Components/SearchLogo.vue';
import CustomerLogo from '@/Components/CustomerLogo.vue';
import CartLogo from '@/Components/CartLogo.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);



const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />
        

        <div class="min-h-screen">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between pt-12 pb-24 items-center">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                               
                                    <ApplicationMark class="block h-24 w-auto" />
                         
                            </div>  
                        </div>
                        
                        <div class="flex gap-8">
                            <Link :href="route('orders.show')"> <CustomerLogo class="h-10"/></Link>
                           <Link :href="route('cart.show')" > <CartLogo class="h-10"/></Link>     
                        </div>
                    </div>
                </div>
            </nav>

            <Navbar/>

            <!-- Page Content -->
            <main>
                <slot />
            </main>

            <footer class="bg-[#C3A181] p-12 font-neulis">
                <div class="max-w-7xl  mx-auto px-4 sm:px-6 lg:px-8 flex flex-col relative gap-24">

                    <div class="flex flex-col md:flex-row justify-between text-white">
                    <div class="flex flex-col items-center justify-center sm:items-start sm:justify-start  sm:flex-row gap-12 w-full md:w-2/3">
                    
                    <div class="">
                <a href="" class="font-bold">Accueil</a>
                </div>
                <div class="flex flex-col gap-4">
                    <a href="" class="font-bold">Mes créations</a>

                    <ul class="opacity-70 ">
                        <li>Décorations</li>
                        <li>Faire-Parts</li>
                        <li>Objets personalisés</li>
                    </ul>
                </div>
                <div class="flex flex-col gap-4">
                    <a href="" class="font-bold">Objets thématiques</a>

                    <ul class="opacity-70 ">
                        <li>Noël</li>
                        <li>Halloween</li>
                        <li>Pâques</li>
                        <li>Fêtes des mères</li>
                    </ul>
                </div>
                <div>
                    <a href="" class="font-bold">En solde</a>
                </div>
                </div>

                <div class="flex flex-col w-full md:w-1/3 items-center md:items-end justify-between">

                    <ApplicationLogoWhite class=" w-[75%] h-1/2 mb-24 mt-24 md:mt-0 md:mb-48"/>
                    <div class="flex gap-4">
                        <a href=""><TikTokLogo/></a>
                        <a href=""><InstaLogo/></a>
                    </div>


                </div>

                


                </div>
                  

                    <div class="flex gap-8 items-center justify-center text-white">
                        <a href="#">Conditions générales de vente</a>
                        <a href="">Mentions légales</a>
                        <a href="">Mon compte</a>
                        <a href="">Contact</a>
                    </div>

                </div>

                
            </footer>
        </div>
    </div>
</template>
