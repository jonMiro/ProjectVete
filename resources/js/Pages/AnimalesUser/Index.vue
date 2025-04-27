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

    <div class="container mx-auto mt-10 px-4">
      <!-- Si no hay animales -->
      <div v-if="animales.length === 0" class="mt-4 text-center">
        <p class="text-lg text-gray-600">¡No tienes mascotas asociadas! ¿Te gustaría añadir una?</p>
      <!--    <Link :href="route('animalesUser.create')" class="text-blue-500 underline">Añadir una mascota</Link>
       -->
    </div>

      <!-- Si hay animales -->
      <div v-else>
        <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
          <div class="bg-blue-600 text-white text-center py-4">
            <h2 class="text-lg font-semibold">Mis Mascotas</h2>
          </div>

          <div class="p-6">
            <div v-for="animal in animales" :key="animal.id" class="flex flex-col lg:flex-row items-start mb-6">
              <!-- Información del animal -->
              <div class="lg:w-1/2 pr-6">
                <p class="mb-2 text-base"><strong>Nombre:</strong> {{ animal.nombre }}</p>
                <p class="mb-2 text-base"><strong>Tipo:</strong> {{ animal.tipo }}</p>
                <p class="mb-2 text-base"><strong>Raza:</strong> {{ animal.raza }}</p>
                <p class="mb-2 text-base"><strong>Sexo:</strong> {{ animal.sexo }}</p>
                <p class="mb-2 text-base"><strong>Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>
                <p class="mb-2 text-base"><strong>Observaciones</strong> {{ animal.observaciones }}</p>
            </div>

              <!-- Imagen del animal -->
              <div v-if="animal.imagen" class="lg:w-1/2 mt-6 lg:mt-0">
                <img :src="animal.imagen" alt="Imagen del animal" class="w-full h-auto rounded-lg shadow-md">
              </div>
               <!-- Botones de editar, eliminar y volver -->
               <div class="flex justify-center gap-4 mt-4">
                    <Link :href="route('clients.animales.edit', animal.id)" class="bg-yellow-500 text-white mb-4 py-2 px-4 rounded-lg hover:bg-yellow-600 text-sm">
                        Editar
                    </Link>

                    <button @click="eliminarAnimal" class="bg-red-500 text-white py-2 px-4 mb-4 rounded-lg hover:bg-red-600 text-sm">
                        Eliminar
                    </button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
