<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import { router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
  servicios: Object,
});

const changeOrder = (newOrder) => {
 order.value = newOrder;
 currentPage.value = 1;
};

const order = ref('desc');
const currentPage = ref(1);
const perPage = 10;


const sortedServicios = computed(() => {
  return [...props.servicios].sort((a, b) => {
    const dateA = new Date(a.fecha);
    const dateB = new Date(b.fecha);
    return order.value === 'asc' ? dateA - dateB : dateB - dateA;
  });
});

const paginatedServicios = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return sortedServicios.value.slice(start, start + perPage);
});

const totalPages = computed(() => Math.ceil(sortedServicios.value.length / perPage))


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
        Inertia.visit(route('servicios.index'));
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

        <!-- Botones de orden -->
<div class="flex justify-center items-center flex-wrap gap-2 mb-6">
  <button
    class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
    :class="order === 'desc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
    @click="changeOrder('desc')"
  >
    Más recientes
  </button>
  <button
    class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
    :class="order === 'asc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
    @click="changeOrder('asc')"
  >
    Más antiguos
  </button>
</div>
        <div v-if="paginatedServicios.length > 0">
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
              <tr v-for="servicio in paginatedServicios" :key="servicio.id" class="hover:bg-blue-50">
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

          <!-- Paginación -->
        <div class="flex justify-center mt-6 space-x-2">
          <button
            @click="currentPage--"
            :disabled="currentPage === 1"
            class="px-3 py-1 border rounded text-sm bg-blue-500 text-white hover:bg-blue-600 disabled:opacity-50"
          >
            Anterior
          </button>

          <span
            v-for="page in totalPages"
            :key="page"
            class="px-3 py-1 border rounded text-sm cursor-pointer"
            :class="{
              'bg-blue-500 text-white': page === currentPage,
              'hover:bg-gray-100': page !== currentPage
            }"
            @click="currentPage = page"
          >
            {{ page }}
          </span>

          <button
            @click="currentPage++"
            :disabled="currentPage === totalPages"
            class="px-3 py-1 border rounded text-sm bg-blue-500 text-white hover:bg-blue-600 disabled:opacity-50"
          >
            Siguiente
          </button>
        </div>
      </div>

        <p v-else class="text-center text-lg text-gray-500">No hay servicios registrados.</p>
      </div>
      <FooterWorkers />
    </AppLayout>
  </template>
