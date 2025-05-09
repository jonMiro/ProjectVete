<script setup>
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import UserCard from '@/Components/UserCard.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';


defineProps({
    user: Object,
});
</script>

<template>
    <AppLayout title="Panel de Usuario">
        <template #header>
            <NavBar />
        </template>

        <UserCard :user="user" />
        <FooterWorkers />
    </AppLayout>
</template>
