<script setup>
import { Link, Inertia } from '@inertiajs/inertia-vue3';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    user: Object,
});

const eliminarUsuario = () => {
    if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
        Inertia.delete(route('users.destroy', user.id), {
            onSuccess: () => {
                alert("¡Usuario eliminado correctamente!");
                Inertia.visit(route('users.index'));
            },
            onError: (errors) => {
                console.log(errors);
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Panel de Usuario">
        <template #header>
            <!--NavBar component-->
            <NavBar />
        </template>

            <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-600 text-white text-center py-4">
                    <h2 class="text-lg font-semibold">Detalles del usuario</h2>
                </div>
                <div class="p-6 flex flex-col lg:flex-row items-start">
                    <!-- Información del animal -->
                    <div class="lg:w-1/2 pr-6">
                        <p class="mb-2 text-base"><strong>ID usuario:</strong> {{ user.id }}</p>
                        <p class="mb-2 text-base"><strong>Nombre:</strong> {{ user.name }}</p>
                        <p class="mb-2 text-base"><strong>Tipo:</strong> {{ user.tipo }}</p>
                        <p class="mb-2 text-base"><strong>Correo:</strong> {{ user.email }}</p>
                        <p class="mb-2 text-base"><strong>Direccion:</strong> {{ user.direccion }}</p>
                        <p class="mb-2 text-base"><strong>Telefono:</strong> {{ user.telefono }}</p>
                    </div>
                </div>

                <!-- Botones de editar, eliminar y volver -->
                <div class="flex justify-center gap-4 mt-4">
                    <Link :href="route('users.edit', user.id)" class="bg-yellow-500 text-white mb-4 py-2 px-4 rounded-lg hover:bg-yellow-600 text-sm">
                        Editar
                    </Link>

                    <!-- El botón de eliminación con el mismo estilo que los demás -->
                    <button @click="eliminarUsuario" class="bg-red-500 text-white py-2 px-4 mb-4 rounded-lg hover:bg-red-600 text-sm">
                        Eliminar
                    </button>

                    <Link :href="route('users.index')" class="bg-gray-600 text-white mb-4 py-2 px-4 rounded-lg hover:bg-gray-700 text-sm">
                        Volver
                    </Link>
                </div>
            </div>

    </AppLayout>
</template>
