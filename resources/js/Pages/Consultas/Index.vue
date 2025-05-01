<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import FooterWorkers from '@/Components/FooterWorkers.vue';


defineProps({
  consultas: Object,
});

const deleteConsulta = (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta consulta?')) {
    Inertia.delete(route('consultas.destroy', id), {
      onSuccess: () => {
        Inertia.visit(route('consultas.index'));
      }
    });
  }
};

// Función para formatear la fecha
const formatDate = (date) => {
  const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
  return new Date(date).toLocaleDateString('es-ES', options); // 'es-ES' para formato español (día-mes-año)
};
</script>

<template>
  <AppLayout title="Panel de Consultas">
    <template #header>
      <NavBar />
    </template>

    <!-- Botón de crear nueva consulta -->
    <div class="flex justify-end mb-2">
      <Link :href="route('consultas.create')" class="text-sm bg-blue-400 text-blue-900 px-3 py-1 m-6 mr-5 rounded-md hover:bg-blue-500 transition shadow-sm mr-2">
        + Nueva Consulta
      </Link>
    </div>

    <div class="container mx-auto mt-2 px-4 mb-2">
      <h2 class="text-center text-3xl font-semibold mb-4">Listado de Consultas</h2>

      <!-- Vista en tabla -->
      <div v-if="consultas.data.length > 0">
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
            <tr v-for="consulta in consultas.data" :key="consulta.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ consulta.id }}</td>
              <td class="border px-4 py-2">{{ formatDate(consulta.fecha) }}</td> <!-- Usamos la función para formatear la fecha -->
              <td class="border px-4 py-2">{{ consulta.animal.nombre }}</td>
              <td class="border px-4 py-2">{{ consulta.user.name }} {{ consulta.user.apellidos }}</td>
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

        <!-- Paginación personalizada -->
        <div class="flex justify-center mt-6 space-x-2">
          <!-- Botón Anterior -->
          <Link
            v-if="consultas.prev_page_url"
            :href="consultas.prev_page_url"
            class="px-3 py-1 border rounded text-sm bg-blue-500 text-white hover:bg-blue-600"
          >
            Anterior
          </Link>
          <span
            v-else
            class="px-3 py-1 border rounded text-sm text-gray-500 cursor-default"
          >
            Anterior
          </span>

          <!-- Páginas numéricas -->
          <span v-for="(link, index) in consultas.links" :key="index">
            <Link
              v-if="link.url"
              :href="link.url"
              class="px-3 py-1 border rounded text-sm"
              :class="{
                'bg-blue-500 text-white': link.active,
                'text-gray-500 cursor-default': !link.url
              }"
            >
              {{ link.label }}
            </Link>
          </span>

          <!-- Botón Siguiente -->
          <Link
            v-if="consultas.next_page_url"
            :href="consultas.next_page_url"
            class="px-3 py-1 border rounded text-sm bg-blue-500 text-white hover:bg-blue-600"
          >
            Siguiente
          </Link>
          <span
            v-else
            class="px-3 py-1 border rounded text-sm text-gray-500 cursor-default"
          >
            Siguiente
          </span>
        </div>
      </div>

      <!-- Mensaje si no hay consultas -->
      <p v-else class="text-center text-lg text-gray-500">No hay consultas registradas.</p>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
