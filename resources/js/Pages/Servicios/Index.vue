<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import FooterWorkers from '@/Components/FooterWorkers.vue';



defineProps({
  servicios: Object,
});

//formatejar fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};

// formatejar hora
const formatTime = (time) => {
  if (!time) return 'No disponible';
  const date = new Date(`1970-01-01T${time}Z`);
  return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
};

// Delete
const deleteServicio = (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar este servicio?')) {
    Inertia.delete(route('servicios.destroy', id),{
    onSuccess: () => {
        Inertia.visit(route('sevicios.index'));
      }
    });
  }
};
</script>


<template>
    <AppLayout title="Panel de Servicios">
      <template #header>
        <NavBar />
      </template>

      <div class="container mx-auto mt-2 px-4 mb-2">
        <h2 class="text-center text-3xl font-semibold text-gray-700 mb-6 mt-6">Listado de Servicios</h2>

        <div v-if="servicios.data.length > 0">
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Tipo de Servicio</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Precio</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Auxiliar</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Animal</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Hora</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="servicio in servicios.data" :key="servicio.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ servicio.id }}</td>
                <td class="border px-4 py-2">{{ formatDate(servicio.fecha) }}</td>
                <td class="border px-4 py-2">{{ servicio.tipo_servicio }}</td>
                <td class="border px-4 py-2">${{ servicio.precio }}</td>
                <td class="border px-4 py-2">{{ servicio.user.name }}</td>
                <td class="border px-4 py-2">{{ servicio.animal.nombre }}</td>
                <td class="border px-4 py-2">{{ formatTime(servicio.hora) }}</td>
                <td class="border px-4 py-2">
                  <div class="flex space-x-2 justify-center">
                    <!-- Botons -->
                    <Link :href="route('servicios.show', servicio.id)" class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200">Mostrar</Link>
                    <Link :href="route('servicios.edit', servicio.id)" class="bg-gray-200 text-gray-800 text-sm py-1 px-2 rounded-lg hover:bg-gray-300">Editar</Link>
                    <button @click="deleteServicio(servicio.id)" class="bg-red-200 text-red-800 text-sm py-1 px-2 rounded-lg hover:bg-red-300">Eliminar</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Paginación-->
          <div class="flex justify-center mt-6 space-x-2">
            <!-- Anterior -->
            <Link
              v-if="servicios.prev_page_url"
              :href="servicios.prev_page_url"
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

            <!-- Págines-->
            <span v-for="(link, index) in servicios.links" :key="index">
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

            <!-- Siguiente ARREGLAR -->
            <Link
              v-if="servicios.next_page_url"
              :href="servicios.next_page_url"
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

        <p v-else class="text-center text-lg text-gray-500">No hay servicios registrados.</p>
      </div>
      <FooterWorkers />
    </AppLayout>
  </template>
