<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  animales: Array,
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
    </template>

    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tus Mascotas</h2>
        <Link
          :href="route('clients.animales.create')"
          class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4 mr-2"
        >
          Añadir Mascota
        </Link>
      </div>
    <div class="container mx-auto mt-10 px-4">

      <!-- Si no hay animales -->
      <div v-if="animales.length === 0" class="mt-4 text-center">
        <p class="text-lg text-gray-600">¡No tienes mascotas asociadas! ¿Te gustaría añadir una?</p>
      <!--    <Link :href="route('animalesUser.create')" class="text-blue-500 underline">Añadir una mascota</Link>
       -->
    </div>

      <!-- Si hay animales -->
<div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <div v-for="animal in animales" :key="animal.id" class="bg-white shadow-md rounded-lg overflow-hidden">
    <div class="bg-blue-600 text-white text-center py-4">
      <h2 class="text-lg font-semibold">{{ animal.nombre }}</h2>
    </div>

    <div class="p-6">
      <!-- Información del animal -->
      <p class="mb-2 text-base"><strong>Tipo:</strong> {{ animal.tipo }}</p>
      <p class="mb-2 text-base"><strong>Raza:</strong> {{ animal.raza }}</p>
      <p class="mb-2 text-base"><strong>Sexo:</strong> {{ animal.sexo }}</p>
      <p class="mb-2 text-base"><strong>Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>
      <p class="mb-2 text-base"><strong>Observaciones:</strong> {{ animal.observaciones }}</p>

      <!-- Imagen del animal -->
      <div v-if="animal.imagen" class="mt-4">
        <img :src="animal.imagen" alt="Imagen del animal" class="w-full h-auto rounded-lg shadow-md">
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-4 mt-4">
        <Link :href="route('clients.animales.edit', animal.id)" class="bg-yellow-500 text-white py-2 px-4 rounded-lg hover:bg-yellow-600 text-sm">
          Editar
        </Link>
        <button @click="eliminarAnimal" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 text-sm">
          Eliminar
        </button>
      </div>
    </div>
  </div>
</div>
    </div>
  </AppLayout>
</template>
