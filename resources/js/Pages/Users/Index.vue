<script setup>
import { ref } from 'vue';
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

// Datos pasados como props
const props = defineProps({
  veterinarios: Array,
  auxiliares: Array,
  clientes: Array,
  animales: Array, // Aquí añadimos los animales como prop
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
            <h3 class="text-xl font-semibold text-gray-800">
              <Link :href="route('users.show', veterinario.id)" class="text-blue-500 hover:underline">
                {{ veterinario.name }} {{ veterinario.apellidos }}
              </Link>
            </h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ veterinario.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ veterinario.email }}</p>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else>
          <table class="table-auto w-full text-center border-collapse table-fixed">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Teléfono</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Correo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="veterinario in veterinarios" :key="veterinario.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ veterinario.name }} {{ veterinario.apellidos }} </td>
                <td class="border px-4 py-2">{{ veterinario.telefono }}</td>
                <td class="border px-4 py-2">{{ veterinario.email }}</td>
                <td class="border px-4 py-2">
                  <Link :href="route('users.show', veterinario.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Lo mismo para Auxiliares, Clientes y Animales -->

        <!-- Auxiliares -->
        <h2 class="text-2xl font-semibold mb-4 mt-8 text-center">Auxiliares</h2>

        <!-- Modo Grid -->
        <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="auxiliar in auxiliares" :key="auxiliar.id" class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800">
              <Link :href="route('users.show', auxiliar.id)" class="text-blue-500 hover:underline">
                {{ auxiliar.name }} {{ auxiliar.apellidos }}
              </Link>
            </h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ auxiliar.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ auxiliar.email }}</p>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else>
          <table class="table-auto w-full text-center border-collapse table-fixed">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Teléfono</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Correo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="auxiliar in auxiliares" :key="auxiliar.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ auxiliar.name }} {{ auxiliar.apellidos }}</td>
                <td class="border px-4 py-2">{{ auxiliar.telefono }}</td>
                <td class="border px-4 py-2">{{ auxiliar.email }}</td>
                <td class="border px-4 py-2">
                  <Link :href="route('users.show', auxiliar.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Clientes -->
        <h2 class="text-2xl font-semibold mb-4 mt-8 text-center">Clientes</h2>

        <!-- Modo Grid -->
        <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="cliente in clientes" :key="cliente.id" class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800">
              <Link :href="route('users.show', cliente.id)" class="text-blue-500 hover:underline">
                {{ cliente.name }} {{ cliente.apellidos }}
              </Link>
            </h3>
            <p><strong class="font-medium">Teléfono:</strong> {{ cliente.telefono }}</p>
            <p><strong class="font-medium">Correo:</strong> {{ cliente.email }}</p>
          </div>
        </div>

        <!-- Modo Tabla -->
        <div v-else>
          <table class="table-auto w-full text-center border-collapse table-fixed">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Teléfono</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4">Correo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700 w-1/4"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cliente in clientes" :key="cliente.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ cliente.name }} {{ cliente.apellidos }}</td>
                <td class="border px-4 py-2">{{ cliente.telefono }}</td>
                <td class="border px-4 py-2">{{ cliente.email }}</td>
                <td class="border px-4 py-2">
                  <Link :href="route('users.show', cliente.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Animales -->
        <h2 class="text-2xl font-semibold mb-4 mt-8 text-center">Animales</h2>

        <!-- Modo Grid -->
        <div v-if="isListView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="animal in animales" :key="animal.id" class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800"><Link :href="route('animales.show', animal.id)" class="text-blue-500 hover:underline">
                {{ animal.nombre }}
              </Link></h3>
            <p><strong class="font-medium">Tipo:</strong> {{ animal.tipo }}</p>
            <p><strong class="font-medium">Raza:</strong> {{ animal.raza }}</p>
            <p><strong class="font-medium">Sexo:</strong> {{ animal.sexo }}</p>
            <p><strong class="font-medium">Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>
            <p><strong class="font-medium">Cliente:</strong> {{ animal.user.name }} {{ animal.user.apellidos }}</p>
          </div>
        </div>

         <!-- Modo Tabla -->
         <div v-else>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>

                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID Animal</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Tipo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Raza</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Sexo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha Nacimiento</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Cliente</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="animal in animales" :key="animal.id" class="hover:bg-blue-50">

                <td class="border px-4 py-2">{{ animal.nombre }}</td>
                <td class="border px-4 py-2">{{ animal.id }}</td>
                <td class="border px-4 py-2">{{ animal.tipo }}</td>
                <td class="border px-4 py-2">{{ animal.raza }}</td>
                <td class="border px-4 py-2">{{ animal.sexo }}</td>
                <td class="border px-4 py-2">{{ animal.fechaNacimiento }}</td>
                <td class="border px-4 py-2">
                  <Link :href="route('users.show', animal.user.id)" class="text-blue-500 hover:underline">
                    {{ animal.user.name }} {{ animal.user.apellidos }}
                  </Link>
                </td>
                <td class="border px-4 py-2">
                  <Link :href="route('animales.show', animal.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AppLayout>
  </template>
