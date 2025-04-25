<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

defineProps({
  servicios: Object, // paginated
});

// Función para formatear la fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};

// Función para formatear la hora
const formatTime = (time) => {
  if (!time) return 'No disponible';
  const date = new Date(`1970-01-01T${time}Z`);
  return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
};

// Función para eliminar un servicio
const deleteServicio = (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar este servicio?')) {
    axios.delete(route('servicios.destroy', id))
      .then(() => {
        // Refrescar la lista de servicios o manejar la respuesta
        alert('Servicio eliminado correctamente');
        // Puedes actualizar la lista de servicios aquí, o redirigir a otra página
      })
      .catch((error) => {
        console.error('Error al eliminar el servicio:', error);
        alert('Hubo un problema al eliminar el servicio.');
      });
  }
};
</script>


<template>
  <AppLayout title="Panel de Servicios">
    <template #header>
      <NavBar />
    </template>

    <!-- Botón de crear nueva consulta -->
    <div class="flex justify-end mb-4">
      <Link :href="route('servicios.create')" class="text-sm bg-blue-400 text-blue-900 px-3 py-1 m-6 mr-5 rounded-md hover:bg-blue-500 transition shadow-sm mr-2">
        + Nuevo
      </Link>
    </div>

    <div class="container mx-auto mt-10 px-4 mb-10">
      <h2 class="text-center text-3xl font-semibold mb-8">Listado de Servicios</h2>

      <div v-if="servicios.data.length > 0">
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
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Hora</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="servicio in servicios.data" :key="servicio.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ servicio.id }}</td>
              <td class="border px-4 py-2">{{ servicio.tipo_servicio }}</td>
              <td class="border px-4 py-2">{{ servicio.descripcion }}</td>
              <td class="border px-4 py-2">{{ servicio.duracion }} minutos</td>
              <td class="border px-4 py-2">${{ servicio.precio }}</td>
              <td class="border px-4 py-2">{{ servicio.user.name }}</td>
              <td class="border px-4 py-2">{{ servicio.animal.nombre }}</td>
              <td class="border px-4 py-2">{{ formatDate(servicio.fecha) }}</td>
              <td class="border px-4 py-2">{{ formatTime(servicio.hora) }}</td>
              <td class="border px-4 py-2">
                <div class="flex space-x-2 justify-center">
                <Link :href="route('servicios.show', servicio.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
                  <Link :href="route('servicios.edit', servicio.id)" class="bg-yellow-500 text-white text-sm py-1 px-2 rounded-lg hover:bg-yellow-600">Editar</Link>
                  <button @click="deleteServicio(servicio.id)" class="bg-red-500 text-white text-sm py-1 px-2 rounded-lg hover:bg-red-600">Eliminar</button>
                </div>
            </td>
            </tr>
          </tbody>
        </table>

        <!-- Paginación personalizada -->
        <div class="flex justify-center mt-6 space-x-2">
          <!-- Botón Anterior -->
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

          <!-- Páginas numéricas -->
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

          <!-- Botón Siguiente -->
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
  </AppLayout>
</template>
