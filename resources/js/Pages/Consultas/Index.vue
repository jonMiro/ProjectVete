<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia'; // Asegúrate de importar Inertia

defineProps({
  consultas: Array,
});

const isListView = ref(false);

const deleteConsulta = (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta consulta?')) {
    Inertia.delete(route('consultas.destroy', id), {
      onSuccess: () => {
        Inertia.visit(route('consultas.index')); // Redirige a la lista de consultas
      }
    });
  }
};
</script>

<template>
  <AppLayout title="Panel de Consultas">
    <template #header>
      <NavBar />
    </template>

    <!--Botón de crear nueva consulta -->
    <div class="flex justify-end mb-4">
      <Link :href="route('consultas.create')" class="text-sm bg-blue-400 text-blue-900 px-3 py-1 m-6 mr-5 rounded-md hover:bg-blue-500 transition shadow-sm mr-2">+ Nueva Consulta</Link>
    </div>

    <div class="container mx-auto mt-4 px-4 mb-10">
      <h2 class="text-center text-3xl font-semibold mb-8">Listado de Consultas</h2>

      <!-- Toggle entre modo grid y tabla -->
      <div class="flex items-center justify-center mb-6">
        <label for="toggle-view" class="mr-2 text-lg">Modo de vista</label>
        <input type="checkbox" id="toggle-view" v-model="isListView" class="h-4 w-4" />
        <span class="ml-2">Modo Grid / Modo Tabla</span>
      </div>

      <!-- Vista en tarjetas -->
      <div v-if="isListView && consultas.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="consulta in consultas" :key="consulta.id" class="bg-white shadow-lg rounded-lg overflow-hidden">
          <div class="p-6">
            <h5 class="text-xl font-semibold text-blue-500 mb-2">Consulta ID: {{ consulta.id }}</h5>
            <p class="text-lg"><strong>Fecha:</strong> {{ consulta.fecha }}</p>
            <p class="text-lg"><strong>Animal:</strong> {{ consulta.animal.nombre }} ({{ consulta.raza }})</p>
            <p class="text-lg"><strong>Veterinario:</strong> {{ consulta.veterinario.nombre }} {{ consulta.veterinario.apellidos }}</p>
            <p class="text-lg"><strong>Motivo:</strong> {{ consulta.motivo }}</p>
            <p class="text-lg"><strong>Tratamiento:</strong> {{ consulta.tratamiento }}</p>
            <p class="text-lg"><strong>Observaciones:</strong> {{ consulta.observaciones }}</p>
          </div>
          <div class="bg-gray-100 text-center py-4">
            <Link :href="route('consultas.show', consulta.id)" class="bg-blue-400 text-white py-2 px-4 rounded-lg hover:bg-blue-500">Ver detalles</Link>
          </div>
        </div>
      </div>

      <!-- Vista en tabla -->
      <div v-else-if="!isListView && consultas.length > 0">
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400">ID</th>
              <th class="px-4 py-2 border-b-2 border-blue-400">Fecha</th>
              <th class="px-4 py-2 border-b-2 border-blue-400">Animal</th>
              <th class="px-4 py-2 border-b-2 border-blue-400">Veterinario</th>
              <th class="px-4 py-2 border-b-2 border-blue-400">Motivo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400">Tratamiento</th>
              <th class="px-4 py-2 border-b-2 border-blue-400">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="consulta in consultas" :key="consulta.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ consulta.id }}</td>
              <td class="border px-4 py-2">{{ consulta.fecha }}</td>
              <td class="border px-4 py-2">{{ consulta.animal.nombre }}</td>
              <td class="border px-4 py-2">{{ consulta.veterinario.nombre }} {{ consulta.veterinario.apellidos }}</td>
              <td class="border px-4 py-2">{{ consulta.motivo }}</td>
              <td class="border px-4 py-2">{{ consulta.tratamiento }}</td>
              <td class="border px-4 py-2">
                <div class="flex space-x-2 justify-center">
                  <Link :href="route('consultas.show', consulta.id)" class="bg-blue-500 text-white text-sm py-1 px-2 rounded-lg hover:bg-blue-600">Ver</Link>
                  <Link :href="route('consultas.edit', consulta.id)" class="bg-yellow-500 text-white text-sm py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</Link>
                  <button @click="deleteConsulta(consulta.id)" class="bg-red-500 text-white text-sm py-1 px-2 rounded-lg hover:bg-red-600">Eliminar</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Mensaje si no hay consultas -->
      <p v-else class="text-center text-lg text-gray-500">No hay consultas registradas.</p>
    </div>
  </AppLayout>
</template>
