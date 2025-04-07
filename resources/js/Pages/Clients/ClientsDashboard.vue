<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBarClients from '@/Components/NavBarClients.vue';
</script>

<template>
    <AppLayout title="Panel de Usuarios">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de Usuarios
            </h2>
            
        </template>

        <div class="p-6 text-gray-700">
            Aquí irá el contenido del panel de usuarios.
        </div>
    </AppLayout>
</template>
