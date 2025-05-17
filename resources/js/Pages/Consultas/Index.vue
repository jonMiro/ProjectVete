<script setup>
import NavBar from '@/Components/NavBar.vue';
import { ref, computed, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';


const props = defineProps({
  consultas: Array,
});

const order = ref('desc');
const currentPage = ref(1);
const perPage = 10;

// Cambiar orden
const changeOrder = (newOrder) => {
  order.value = newOrder;
  currentPage.value = 1;
};

const search = ref('');

watch(search, () => {
  currentPage.value = 1;
});

const sortedConsultas = computed(() => {
  return [...props.consultas]
    .filter(consulta =>
      consulta.animal?.nombre?.toLowerCase().includes(search.value.toLowerCase())
    )
    .sort((a, b) => {
      const dateA = new Date(a.fecha);
      const dateB = new Date(b.fecha);
      return order.value === 'asc' ? dateA - dateB : dateB - dateA;
    });
});

const paginatedConsultas = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return sortedConsultas.value.slice(start, start + perPage);
});

const totalPages = computed(() => Math.ceil(sortedConsultas.value.length / perPage));

const formatDate = (date) => {
  if (!date) return 'No disponible';
  return new Date(date).toLocaleDateString('es-ES', {
    year: 'numeric', month: 'long', day: 'numeric'
  });
};

const formatTime = (time) => {
  if (!time) return 'No disponible';
  const date = new Date(`1970-01-01T${time}Z`);
  return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
};

const deleteConsulta = (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta consulta?')) {
    Inertia.delete(route('consultas.destroy', id), {
      onSuccess: () => {
        location.reload();
      },
    });
  }
};
</script>

<template>
  <AppLayout title="Panel de Consultas">
    <template #header>
      <NavBar />
    </template>

    <div class="flex flex-col min-h-screen">
      <div class="container mx-auto mt-2 px-4 mb-2 flex-grow">

        <!-- Búsqueda -->
        <div class="flex justify-center mb-6 mt-6">
          <input
            v-model="search"
            type="text"
            placeholder="Buscar por nombre del animal..."
            class="w-full max-w-md px-4 py-2 border border-blue-200 rounded-lg"
          />
        </div>

        <!-- Botones de orden -->
        <div class="flex justify-center items-center flex-wrap gap-2 mb-6">
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="order === 'desc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="changeOrder('desc')"
          >
            Recientes
          </button>
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="order === 'asc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="changeOrder('asc')"
          >
            Antiguos
          </button>
        </div>

        <!-- Tabla -->
        <div v-if="paginatedConsultas.length > 0">
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Motivo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Veterinario</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Animal</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Hora</th>
                <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="consulta in paginatedConsultas" :key="consulta.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ formatDate(consulta.fecha) }}</td>
                <td class="border px-4 py-2">{{ consulta.motivo }}</td>
                <td class="border px-4 py-2">{{ consulta.user?.name }}</td>
                <td class="border px-4 py-2">{{ consulta.animal?.nombre }}</td>
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

          <!-- Paginación-->
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
        <div v-else class="text-center text-gray-500 mt-8">No hay consultas disponibles.</div>
      </div>

      <FooterWorkers />
    </div>
  </AppLayout>
</template>
