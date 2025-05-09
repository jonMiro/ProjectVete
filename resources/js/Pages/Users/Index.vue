<script setup>
import { ref } from 'vue';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const props = defineProps({
  veterinarios: Array,
  auxiliares: Array,
  clientes: Array,
  animales: Array,
});

// modo vista
const isListView = ref(false);
</script>

<template>
  <AppLayout title="Panel de Trabajadores">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto mt-2 px-4 mb-6">
      <!-- Checkbox tabla/tarj -->
      <div class="flex items-center mb-6">
        <label for="toggle-view" class="mr-2 text-md">Modo de vista</label>
        <input
          type="checkbox"
          id="toggle-view"
          v-model="isListView"
          class="h-4 w-4"
        />
      </div>

      <h2 class="text-center text-3xl font-semibold text-gray-700 mb-6 mt-6">Lista de Trabajadores</h2>

      <!-- Modo Grid: Veterinarios -->
      <h2 class="text-2xl font-semibold mb-4 mt-8 text-gray-700 text-center">Veterinarios</h2>

      <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="veterinario in veterinarios" :key="veterinario.id" class="bg-white shadow-lg rounded-lg overflow-hidden transition-all transform hover:scale-105 hover:shadow-xl">
          <Link :href="route('users.show', veterinario.id)" class="block p-6 transition duration-300">
            <h3 class="text-xl font-semibold text-blue-600 mb-4">
              {{ veterinario.name }} {{ veterinario.apellidos }}
            </h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ veterinario.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ veterinario.email }}</p>
          </Link>
        </div>
      </div>

      <!-- Modo Tabla: Veterinarios -->
      <div v-else>
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Teléfono</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Correo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="veterinario in veterinarios" :key="veterinario.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ veterinario.name }} {{ veterinario.apellidos }}</td>
              <td class="border px-4 py-2">{{ veterinario.telefono }}</td>
              <td class="border px-4 py-2">{{ veterinario.email }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('users.show', veterinario.id)" class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200">Mostrar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Auxiliares -->
      <h2 class="text-2xl font-semibold mb-4 mt-8 text-gray-700 text-center">Auxiliares</h2>
      <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="auxiliar in auxiliares" :key="auxiliar.id" class="bg-white shadow-lg rounded-lg overflow-hidden transition-all transform hover:scale-105 hover:shadow-xl">
          <Link :href="route('users.show', auxiliar.id)" class="block p-6 transition duration-300">
            <h3 class="text-xl font-semibold text-blue-600 mb-4">
              {{ auxiliar.name }} {{ auxiliar.apellidos }}
            </h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ auxiliar.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ auxiliar.email }}</p>
          </Link>
        </div>
      </div>

      <div v-else>
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Teléfono</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Correo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="auxiliar in auxiliares" :key="auxiliar.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ auxiliar.name }} {{ auxiliar.apellidos }}</td>
              <td class="border px-4 py-2">{{ auxiliar.telefono }}</td>
              <td class="border px-4 py-2">{{ auxiliar.email }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('users.show', auxiliar.id)" class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200">Mostrar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Clientes -->
      <h2 class="text-2xl font-semibold mb-4 mt-8 text-gray-700 text-center">Clientes</h2>
      <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="cliente in clientes" :key="cliente.id" class="bg-white shadow-lg rounded-lg overflow-hidden transition-all transform hover:scale-105 hover:shadow-xl">
          <Link :href="route('users.show', cliente.id)" class="block p-6  transition duration-300">
            <h3 class="text-xl font-semibold text-blue-600 mb-4">
              {{ cliente.name }} {{ cliente.apellidos }}
            </h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ cliente.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ cliente.email }}</p>
          </Link>
        </div>
      </div>

      <div v-else>
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Teléfono</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Correo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="cliente in clientes" :key="cliente.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ cliente.name }} {{ cliente.apellidos }}</td>
              <td class="border px-4 py-2">{{ cliente.telefono }}</td>
              <td class="border px-4 py-2">{{ cliente.email }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('users.show', cliente.id)" class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200">Mostrar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
