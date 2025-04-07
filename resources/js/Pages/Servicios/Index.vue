<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

defineProps({
  servicios: Array,
});

// Estado para controlar el modo de visualización (lista o tabla)
const isListView = ref(false);
</script>

<template>
  <AppLayout title="Panel de Servicios">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto mt-10 px-4 mb-10">
      <h2 class="text-center text-3xl font-semibold mb-8">Listado de Servicios</h2>

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

      <!-- Si el array de servicios es mayor que 0, mostrar los servicios -->
      <div v-if="isListView && servicios.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="servicio in servicios" :key="servicio.id" class="bg-white shadow-lg rounded-lg overflow-hidden">
          <div class="p-6">
            <h5 class="text-xl font-semibold text-blue-500 mb-4">ID Servicio: {{ servicio.id }}</h5>
            <p class="text-lg"><strong>Tipo de Servicio:</strong> {{ servicio.tipo_servicio }}</p>
            <p class="text-lg"><strong>Descripción:</strong> {{ servicio.descripcion }}</p>
            <p class="text-lg"><strong>Duración:</strong> {{ servicio.duracion }} minutos</p>
            <p class="text-lg"><strong>Precio:</strong> ${{ servicio.precio }}</p>

            <!-- Información del auxiliar y el animal -->
            <p class="text-lg"><strong>Auxiliar:</strong> {{ servicio.auxiliar.nombre }}</p>
            <p class="text-lg"><strong>Animal:</strong> {{ servicio.animal.nombre }} (ID: {{ servicio.animal.id }})</p>
          </div>

          <div class="bg-gray-100 text-center py-4">
            <Link :href="route('servicios.show', servicio.id)" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Mostrar</Link>
          </div>
        </div>
      </div>

      <!-- Modo Tabla -->
      <div v-else-if="!isListView && servicios.length > 0">
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID Servicio</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Tipo de Servicio</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Descripción</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Duración</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Precio</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Auxiliar</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Animal</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="servicio in servicios" :key="servicio.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ servicio.id }}</td>
              <td class="border px-4 py-2">{{ servicio.tipo_servicio }}</td>
              <td class="border px-4 py-2">{{ servicio.descripcion }}</td>
              <td class="border px-4 py-2">{{ servicio.duracion }} minutos</td>
              <td class="border px-4 py-2">${{ servicio.precio }}</td>
              <td class="border px-4 py-2">{{ servicio.auxiliar.nombre }}</td>
              <td class="border px-4 py-2">{{ servicio.animal.nombre }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('servicios.show', servicio.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Si no hay servicios, mostrar mensaje -->
      <p v-else class="text-center text-lg text-gray-500">No hay servicios registrados.</p>
    </div>
  </AppLayout>
</template>
