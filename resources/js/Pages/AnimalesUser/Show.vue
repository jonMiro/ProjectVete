<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import AnimalCard from '@/Components/AnimalCard.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const props = defineProps({
  animal: Object,
});

const eliminarAnimal = () => {
  if (confirm("¿Estás seguro de que deseas eliminar este animal?")) {
    Inertia.delete(route('clients.animales.destroy', props.animal.id), {
      onSuccess: () => {
        alert("¡Animal eliminado correctamente!");
        Inertia.visit(route('clients.animales.index'));
      },
      onError: (errors) => {
        console.log(errors);
      },
    });
  }
};
</script>

<template>
    <AppLayout title="Ficha del Animal">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Ficha de {{ animal.nombre }}
        </h2>
      </template>

      <div v-if="animal" class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-8">
        <div class="bg-blue-600 text-white text-center py-4">
          <h2 class="text-lg font-semibold">Detalles del Animal</h2>
        </div>

        <div class="p-6 flex flex-col lg:flex-row items-start">
          <div class="lg:w-1/2 pr-6">
            <p class="mb-2 text-base"><strong>ID Animal:</strong> {{ animal.id }}</p>
            <p class="mb-2 text-base"><strong>Nombre:</strong> {{ animal.nombre }}</p>
            <p class="mb-2 text-base"><strong>Tipo:</strong> {{ animal.tipo }}</p>
            <p class="mb-2 text-base"><strong>Raza:</strong> {{ animal.raza }}</p>
            <p class="mb-2 text-base"><strong>Sexo:</strong> {{ animal.sexo }}</p>
            <p class="mb-2 text-base"><strong>Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>
            <p class="mb-2 text-base"><strong>Observaciones:</strong> {{ animal.observaciones || 'No hay observaciones' }}</p>
          </div>

          <div v-if="animal.imagen" class="lg:w-1/2 mt-6 lg:mt-0">
            <img :src="animal.imagen" alt="Imagen del animal" class="w-full h-auto rounded-lg shadow-md">
          </div>
        </div>

        <!-- BOTONES -->
        <div class="flex justify-center gap-4 mt-6 mb-4">
          <Link :href="route('clients.animales.edit', animal.id)" class="bg-gray-200 text-gray-800 mb-4 py-2 px-4 rounded-lg hover:bg-gray-400 text-sm">
            Editar
          </Link>

          <button @click="eliminarAnimal" class="bg-red-200 text-red-800 py-2 px-4 mb-4 rounded-lg hover:bg-red-400 text-sm">
            Baja
          </button>

          <Link :href="route('clients.animales.index')" class="bg-blue-200 text-blue-800 mb-4 py-2 px-4 rounded-lg hover:bg-blue-400 text-sm">
            Volver
          </Link>
        </div>
      </div>

      <FooterWorkers />
    </AppLayout>
  </template>
