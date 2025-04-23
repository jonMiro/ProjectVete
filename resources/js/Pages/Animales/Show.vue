<script setup>
import { Link, Inertia } from '@inertiajs/inertia-vue3';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    animal: Object,
});

const eliminarAnimal = () => {
    if (confirm("¿Estás seguro de que deseas eliminar este animal?")) {
        Inertia.delete(route('animales.destroy', animal.id), {
            onSuccess: () => {
                alert("¡Animal eliminado correctamente!");
                Inertia.visit(route('animales.index'));
            },
            onError: (errors) => {
                console.log(errors);
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Panel de Animales">
        <template #header>
            <!--NavBar component-->
            <NavBar />
        </template>

        <div v-if="animal" class="container mx-auto mb-5 mt-10 px-4">
            <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-blue-600 text-white text-center py-4">
                    <h2 class="text-lg font-semibold">Detalles del Animal</h2>
                </div>
                <div class="p-6 flex flex-col lg:flex-row items-start">
                    <!-- Información del animal -->
                    <div class="lg:w-1/2 pr-6">
                        <p class="mb-2 text-base"><strong>ID Animal:</strong> {{ animal.id }}</p>
                        <p class="mb-2 text-base"><strong>Nombre:</strong> {{ animal.nombre }}</p>
                        <p class="mb-2 text-base"><strong>Tipo:</strong> {{ animal.tipo }}</p>
                        <p class="mb-2 text-base"><strong>Raza:</strong> {{ animal.raza }}</p>
                        <p class="mb-2 text-base"><strong>Sexo:</strong> {{ animal.sexo }}</p>
                        <p class="mb-2 text-base"><strong>Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>
                        <p class="mb-2 text-base"><strong>Cliente:</strong>
                            <span v-if="animal.user">
                                {{ animal.user.name }} {{ animal.user.apellidos }}
                            </span>
                            <span v-else>No asignado</span>
                        </p>
                        <p class="mb-2 text-base"><strong>Observaciones:</strong> {{ animal.observaciones || 'No hay observaciones' }}</p>
                    </div>

                    <!-- Imagen del animal a la derecha -->
                    <div v-if="animal.imagen" class="lg:w-1/2 mt-6 lg:mt-0">
                        <img :src="animal.imagen" alt="Imagen del animal" class="w-full h-auto rounded-lg shadow-md">
                    </div>
                </div>

                <!-- Botones de editar, eliminar y volver -->
                <div class="flex justify-center gap-4 mt-4">
                    <Link :href="route('animales.edit', animal.id)" class="bg-yellow-500 text-white mb-4 py-2 px-4 rounded-lg hover:bg-yellow-600 text-sm">
                        Editar
                    </Link>

                    <!-- El botón de eliminación con el mismo estilo que los demás -->
                    <button @click="eliminarAnimal" class="bg-red-500 text-white py-2 px-4 mb-4 rounded-lg hover:bg-red-600 text-sm">
                        Eliminar
                    </button>

                    <Link :href="route('animales.index')" class="bg-gray-600 text-white mb-4 py-2 px-4 rounded-lg hover:bg-gray-700 text-sm">
                        Volver
                    </Link>
                </div>
            </div>
        </div>

        <p v-else class="text-center text-lg">Cargando...</p>
    </AppLayout>
</template>
