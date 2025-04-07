<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
</script>

<template>
    <AppLayout title="Panel de Trabajadores">
        <template #header>

            <!--NavBar component-->
        <NavBar/>
        </template>



        <div class="p-6 text-gray-700">
            Aquí irá el contenido del panel de trabajadores.
        </div>
    </AppLayout>
</template>
