<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
                Gestión aplicaciones veterinarias
            </h2>
        </template>

        <div class="p-6">
            <p class="mb-4 text-gray-700 text-center">Elige una zona:</p>
            <div class="space-y-2">
                <Link href="/workers" class="text-blue-600 hover:underline text-lg block text-center">
                    Ir a la zona de trabajadores
                </Link>
                <Link href="/clients" class="text-green-600 hover:underline text-lg block text-center">
                    Ir a la zona de usuarios / clientes
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
