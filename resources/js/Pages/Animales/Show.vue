<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import AnimalCard from '@/Components/AnimalCard.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';


const props = defineProps({
    animal: Object,
});
</script>

<template>
    <AppLayout title="Panel de Animales">
        <template #header>
            <NavBar />
        </template>

        <div class="container mx-auto mb-5 mt-10 px-4">
            <AnimalCard :animal="props.animal" />
        </div>
        <FooterWorkers />
    </AppLayout>
</template>
