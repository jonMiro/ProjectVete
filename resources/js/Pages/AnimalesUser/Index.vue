<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';

defineProps({
  animales: Array,
});

const eliminarAnimal = (animalId) => {
  if (confirm("¿Estás seguro de que deseas eliminar este animal?")) {
    Inertia.delete(route('animales.destroy', animalId), {
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

const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};
</script>

<template>
    <AppLayout title="Panel de Animales">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Tus Mascotas
        </h2>
      </template>

      <div class="flex flex-col min-h-screen">
        <!-- Contenido principal -->
        <div class="flex-grow">
          <div class="flex justify-center px-4 mt-6">
            <Link
              :href="route('clients.animales.create')"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mt-4 mr-2"
            >
              Alta Mascota
            </Link>
          </div>

          <div class="container mx-auto mt-10 px-4">
            <div v-if="animales.length === 0" class="mt-4 text-center">
              <p class="text-lg text-gray-600">¡No tienes mascotas asociadas! ¿Te gustaría añadir una?</p>
            </div>

           <div v-else class="flex flex-col gap-4">
  <div v-for="animal in animales" :key="animal.id">
    <Link
      :href="route('clients.animales.show', animal.id)"
      class="bg-gradient-to-br from-blue-50 to-white shadow-xl rounded-xl overflow-hidden hover:shadow-2xl transition duration-300 flex w-full"
    >
      <div class="p-4 w-full flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="md:w-2/3 pl-4 space-y-1">
          <h5 class="text-xl font-bold text-blue-700 uppercase">
            {{ animal.nombre }} #{{ animal.id }}
          </h5>
          <p class="text-gray-700"><strong>Tipo:</strong> {{ animal.tipo }}</p>
          <p class="text-gray-700"><strong>Raza:</strong> {{ animal.raza }}</p>
          <p class="text-gray-700"><strong>Sexo:</strong> {{ animal.sexo }}</p>
          <p class="text-gray-700"><strong>Fecha Nac.:</strong> {{ formatDate(animal.fechaNacimiento) }}</p>
        </div>

        <div v-if="animal.imagen" class="md:w-1/3 px-4">
          <img
            :src="animal.imagen"
            alt="Imagen del animal"
            class="rounded-lg max-h-48 object-cover w-full shadow-md"
          />
        </div>
      </div>
    </Link>
  </div>
</div>
        </div>
         </div>


        <FooterWorkers />
      </div>
    </AppLayout>
  </template>
