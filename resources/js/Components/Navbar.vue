<script>
import GhostLogo from './GhostLogo.vue'
import HomeLogo from './HomeLogo.vue'
import DealLogo from './DealLogo.vue'
import StarsLogo from './StarsLogo.vue'
import TikTokLogo from './TikTokLogo.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        GhostLogo,
        HomeLogo,
        DealLogo,
        StarsLogo,
        TikTokLogo,
        Link
    }
}

</script>

<template>
    <div class="w-full bg-[#C3A181]">
        <div class="max-w-7xl mx-auto items-center py-8 text-white px-24 ">
           <div class="flex flex-col gap-y-16 font-neulis font-bold  text-2xl md:flex-row justify-center items-center md:justify-between">
            <Link :href="route('index')" class="flex items-center gap-4"><HomeLogo/> <p>Accueil</p></Link>
            <Link :href="route('products')" class="flex items-center gap-4"><StarsLogo/> <p>Mes créations</p></Link>
            <Link :href="route('products')" class="flex items-center gap-4"><GhostLogo/> <p>Objets thématiques</p></Link>

           </div>
        </div>
    </div>
</template>