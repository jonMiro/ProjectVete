<template>
    <div v-if="user" class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-6">
        <div class="bg-blue-600 text-white text-center py-4">
            <h2 class="text-lg font-semibold">Detalles del Usuario</h2>
        </div>
        <div class="p-6 flex flex-col lg:flex-row items-start">
            <div class="lg:w-full pr-6">
                <p class="mb-2 text-base"><strong>ID Usuario:</strong> {{ user.id }}</p>
                <p class="mb-2 text-base"><strong>Nombre:</strong> {{ user.name }} {{ user.apellidos }}</p>
                <p class="mb-2 text-base"><strong>Tipo:</strong> {{ user.tipo }}</p>
                <p class="mb-2 text-base"><strong>Correo:</strong> {{ user.email }}</p>
                <p class="mb-2 text-base"><strong>Dirección:</strong> {{ user.direccion || 'No indicada' }}</p>
                <p class="mb-2 text-base"><strong>Teléfono:</strong> {{ user.telefono || 'No indicado' }}</p>
            </div>
        </div>

        <div class="flex justify-center gap-4 mt-4">
            <Link :href="route('users.edit', user.id)" class="bg-gray-200 text-gray-800 mb-4 py-2 px-4 rounded-lg hover:bg-gray-400 text-sm">
                Editar
            </Link>

            <button @click="eliminarUsuario" class="bg-red-200 text-red-800 py-2 px-4 mb-4 rounded-lg hover:bg-red-400 text-sm">
                Eliminar
            </button>

            <Link :href="route('users.index')" class="bg-blue-200 text-blue-800 mb-4 py-2 px-4 rounded-lg hover:bg-blue-400 text-sm">
                Volver
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/vue3';


const props = defineProps({
    user: Object,
});

const eliminarUsuario = () => {
    if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
        Inertia.delete(route('users.destroy', props.user.id), {
            onSuccess: () => {
                Inertia.visit(route('users.index'));
            },
        });
    }
};
</script>
