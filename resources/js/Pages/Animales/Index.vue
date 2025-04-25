<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

defineProps({
  animales: Array,
});

// Tabla/grid
const isListView = ref(false);
</script>

<template>
    <AppLayout title="Panel de animales">
      <template #header>
        <NavBar />
      </template>

      <div class="container mx-auto mt-10 px-4">
        <h2 class="text-center text-3xl font-semibold mb-8">Listado de Animales</h2>

        <!-- Checkbox para cambiar entre modo grid (tarjetas) y tabla -->
        <div class="flex items-center justify-center mb-6">
          <label for="toggle-view" class="mr-2 text-lg">Modo de vista</label>
          <input
            type="checkbox"
            id="toggle-view"
            v-model="isListView"
            class="h-4 w-4"
          />
          <span class="ml-2">Modo Grid / Modo Tabla</span>
        </div>

        <!-- mostrar los animales -->
        <div v-if="isListView && animales.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="animal in animales" :key="animal.id" class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
              <h5 class="text-xl font-semibold text-blue-500 mb-4">ID Animal: {{ animal.id }}</h5>
              <p class="text-lg"><strong>Nombre:</strong> {{ animal.nombre }}</p>
              <p class="text-lg"><strong>Tipo:</strong> {{ animal.tipo }}</p>
              <p class="text-lg"><strong>Raza:</strong> {{ animal.raza }}</p>
              <p class="text-lg"><strong>Sexo:</strong> {{ animal.sexo }}</p>
              <p class="text-lg"><strong>Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>

              <!-- Información del cliente -->
              <p class="text-lg"><strong>Cliente:</strong>
                id: {{ animal.user.id }}
                Nombre: {{ animal.user.name }} {{ animal.user.apellidos }}
              </p>

              <!-- Imagen del animal -->
              <div v-if="animal.imagen" class="mt-4">
                <img :src="animal.imagen" alt="Imagen del animal" class="w-full h-48 object-cover rounded-lg shadow-md" />
              </div>
            </div>

            <div class="bg-gray-100 text-center py-4">
              <Link :href="route('animales.show', animal.id)" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Mostrar</Link>
            </div>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else-if="!isListView && animales.length > 0">
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID Animal</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Tipo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Raza</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Sexo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha Nacimiento</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Cliente</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="animal in animales" :key="animal.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ animal.id }}</td>
                <td class="border px-4 py-2">{{ animal.nombre }}</td>
                <td class="border px-4 py-2">{{ animal.tipo }}</td>
                <td class="border px-4 py-2">{{ animal.raza }}</td>
                <td class="border px-4 py-2">{{ animal.sexo }}</td>
                <td class="border px-4 py-2">{{ animal.fechaNacimiento }}</td>
                <td class="border px-4 py-2">{{ animal.user.name }} {{ animal.user.apellidos }}</td>
                <td class="border px-4 py-2">
                  <Link :href="route('animales.show', animal.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Si no hay animales....-->
        <p v-else class="text-center text-lg text-gray-500">No hay animales registrados.</p>
      </div>
    </AppLayout>
  </template>
