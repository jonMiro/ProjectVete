<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import FooterWorkers from '@/Components/FooterWorkers.vue'

defineProps({
  eventos: Array,
  consultas: Array,
  servicios: Array
})
</script>

<template>
  <AppLayout title="Historial">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Historial
      </h2>
    </template>

    <!-- flex min-h -->
    <div class="flex flex-col min-h-[85vh]">
      <!-- Contenido principal -->
      <div class="p-4 space-y-10">
        <!-- Tabla de Consultas -->
        <div v-if="consultas.length > 0">
          <h2 class="text-xl font-semibold mb-2">Consultas</h2>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-green-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-green-400">Fecha</th>
                <th class="px-4 py-2 border-b-2 border-green-400">Animal</th>
                <th class="px-4 py-2 border-b-2 border-green-400">Tipo</th>
                <th class="px-4 py-2 border-b-2 border-green-400">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="consulta in consultas" :key="consulta.id" class="hover:bg-green-50">
                <td class="border px-4 py-2">{{ consulta.fecha }}</td>
                <td class="border px-4 py-2">{{ consulta.animal.nombre }}</td>
                <td class="border px-4 py-2">Consulta</td>
                <td class="border px-4 py-2">
                  <Link :href="route('clients.historial.showConsulta', consulta.id)" class="bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 text-sm">
                    Ver
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Tabla de Servicios -->
        <div v-if="servicios.length > 0">
          <h2 class="text-xl font-semibold mb-2">Servicios</h2>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-yellow-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-yellow-400">Fecha</th>
                <th class="px-4 py-2 border-b-2 border-yellow-400">Animal</th>
                <th class="px-4 py-2 border-b-2 border-yellow-400">Tipo</th>
                <th class="px-4 py-2 border-b-2 border-yellow-400">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="servicio in servicios" :key="servicio.id" class="hover:bg-yellow-50">
                <td class="border px-4 py-2">{{ servicio.fecha }}</td>
                <td class="border px-4 py-2">{{ servicio.animal.nombre }}</td>
                <td class="border px-4 py-2">Servicio</td>
                <td class="border px-4 py-2">
                  <Link :href="route('clients.historial.showServicio', servicio.id)" class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 text-sm">
                    Ver
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!--Otros Eventos -->
        <div v-if="eventos.length > 0">
          <h2 class="text-xl font-semibold mb-2">Eventos Futuros</h2>
          <table class="table-auto w-full text-center border-collapse">
            <thead class="bg-blue-100">
              <tr>
                <th class="px-4 py-2 border-b-2 border-blue-400">Fecha</th>
                <th class="px-4 py-2 border-b-2 border-blue-400">Tipo</th>
                <th class="px-4 py-2 border-b-2 border-blue-400">Acción</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="evento in eventos" :key="evento.id" class="hover:bg-blue-50">
                <td class="border px-4 py-2">{{ evento.fecha }}</td>
                <td class="border px-4 py-2">{{ evento.tipo }}</td>
                <td class="border px-4 py-2">
                  <Link :href="route('clients.historial.showEvento', evento.id)" class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 text-sm">
                    Ver
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- si no hay datos... -->
        <div v-if="consultas.length === 0 && servicios.length === 0 && eventos.length === 0" class="text-center text-gray-500">
          No hay eventos, consultas ni servicios próximos registrados.
        </div>
      </div>

      <div class="mt-auto">
        <FooterWorkers />
      </div>
    </div>
  </AppLayout>
</template>
