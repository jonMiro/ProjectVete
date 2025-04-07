<script setup>
import { ref } from 'vue';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

// Datos pasados como props
const props = defineProps({
  veterinarios: Array,
  auxiliares: Array,
  clientes: Array
});

// Estado para controlar el modo de visualización (lista o tabla)
const isListView = ref(false);
</script>
<template>
    <AppLayout title="Panel de Trabajadores">
      <template #header>
        <NavBar />
      </template>

      <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">Lista de Trabajadores</h1>

        <!-- Checkbox para cambiar entre modo grid (tarjetas) y tabla -->
        <div class="flex items-center mb-6">
          <label for="toggle-view" class="mr-2 text-lg">Modo de vista</label>
          <input
            type="checkbox"
            id="toggle-view"
            v-model="isListView"
            class="h-4 w-4"
          />
          <span class="ml-2">Modo Grid / Modo Tabla</span>
        </div>

        <!-- Veterinarios -->
        <h2 class="text-2xl font-semibold mb-4 text-center">Veterinarios</h2>

        <!-- Modo Grid -->
        <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="veterinario in veterinarios" :key="veterinario.id" class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800">{{ veterinario.nombre }} {{ veterinario.apellidos }}</h3>
            <p><strong class="font-medium">Especialidad:</strong> {{ veterinario.especialidad }}</p>
            <p><strong class="font-medium">Teléfono:</strong> {{ veterinario.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ veterinario.correo }}</p>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Especialidad</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Teléfono</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Correo</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="veterinario in veterinarios" :key="veterinario.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ veterinario.nombre }} {{ veterinario.apellidos }}</td>
                <td class="border px-4 py-2">{{ veterinario.especialidad }}</td>
                <td class="border px-4 py-2">{{ veterinario.telefono }}</td>
                <td class="border px-4 py-2">{{ veterinario.correo }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Lo mismo para Auxiliares y Clientes -->
        <h2 class="text-2xl font-semibold mb-4 mt-8 text-center">Auxiliares</h2>

        <!-- Modo Grid -->
        <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="auxiliar in auxiliares" :key="auxiliar.id" class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800">{{ auxiliar.nombre }} {{ auxiliar.apellidos }}</h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ auxiliar.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ auxiliar.correo }}</p>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Teléfono</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Correo</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="auxiliar in auxiliares" :key="auxiliar.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ auxiliar.nombre }} {{ auxiliar.apellidos }}</td>
                <td class="border px-4 py-2">{{ auxiliar.telefono }}</td>
                <td class="border px-4 py-2">{{ auxiliar.correo }}</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Clientes -->
        <h2 class="text-2xl font-semibold mb-4 mt-8 text-center">Clientes</h2>

        <!-- Modo Grid -->
        <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="cliente in clientes" :key="cliente.id" class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800">{{ cliente.nombre }} {{ cliente.apellidos }}</h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ cliente.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ cliente.correo }}</p>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Teléfono</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Correo</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cliente in clientes" :key="cliente.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ cliente.nombre }} {{ cliente.apellidos }}</td>
                <td class="border px-4 py-2">{{ cliente.telefono }}</td>
                <td class="border px-4 py-2">{{ cliente.correo }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AppLayout>
  </template>
