<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  consultas: Object,
  currentOrder: String,
});

const changeOrder = (order) => {
  router.get(route('consultas.index'), { order }, {
    preserveState: true,
    preserveScroll: true,
  });
};

// Formatear fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};

// Formatear hora
const formatTime = (time) => {
  if (!time) return 'No disponible';
  const date = new Date(`1970-01-01T${time}Z`);
  return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
};

// Eliminar consulta
const deleteConsulta = (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta consulta?')) {
    Inertia.delete(route('consultas.destroy', id),{
      onSuccess: () => {
        Inertia.visit(route('consultas.index'));
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

    <div class="container mx-auto mt-2 px-4 mb-2">
      <h2 class="text-center text-3xl font-semibold text-gray-700 mb-6 mt-6">Listado de Consultas</h2>

      <!-- Botones de orden -->
      <div class="flex justify-center items-center flex-wrap gap-2 mb-6">
        <button
          class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
          :class="currentOrder === 'desc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
          @click="changeOrder('desc')"
        >
          Más recientes
        </button>
        <button
          class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
          :class="currentOrder === 'asc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
          @click="changeOrder('asc')"
        >
          Más antiguos
        </button>
      </div>

      <div v-if="consultas.data.length > 0">
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Motivo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Veterinario</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Animal</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Hora</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="consulta in consultas.data" :key="consulta.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ consulta.id }}</td>
              <td class="border px-4 py-2">{{ formatDate(consulta.fecha) }}</td>
              <td class="border px-4 py-2">{{ consulta.motivo }}</td>
              <td class="border px-4 py-2">{{ consulta.user.name }}</td>
              <td class="border px-4 py-2">{{ consulta.animal.nombre }}</td>
              <td class="border px-4 py-2">{{ formatTime(consulta.hora) }}</td>
              <td class="border px-4 py-2">
                <div class="flex space-x-2 justify-center">
                  <Link :href="route('consultas.show', consulta.id)" class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200">Mostrar</Link>
                  <Link :href="route('consultas.edit', consulta.id)" class="bg-gray-200 text-gray-800 text-sm py-1 px-2 rounded-lg hover:bg-gray-300">Editar</Link>
                  <button @click="deleteConsulta(consulta.id)" class="bg-red-200 text-red-800 text-sm py-1 px-2 rounded-lg hover:bg-red-300">Eliminar</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Paginación -->
        <div class="flex justify-center mt-6 space-x-2">
          <!-- Anterior -->
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

          <!-- Páginas -->
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

          <!-- Siguiente -->
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

      <p v-else class="text-center text-lg text-gray-500">No hay consultas registradas.</p>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
