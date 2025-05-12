<template>
  <AppLayout title="Facturación">
    <template #header>
      <NavBar />
    </template>

    <div class="max-w-6xl mx-auto p-6 mt-6 bg-white shadow rounded-lg">

      <div class="flex justify-between items-center ">
        <!-- Totales -->
        <div class="flex gap-4">

          <div class="text-sm font-semibold text-gray-700">
            <p>Total Servicios: <span class="font-bold">{{ totalServiciosFiltrados }} €</span></p>
            <p>Total Consultas: <span class="font-bold">{{ totalConsultasFiltradas }} €</span></p>
            <p>Total General: <span class="font-bold">{{ totalGeneralFiltrado }} €</span></p>
          </div>
        </div>

        <!-- Filtro por mes -->
        <div class="flex justify-end">
          <label class="mr-2 text-sm font-medium text-gray-700">Filtrar por mes:</label>
          <select v-model="mesSeleccionado" class="border border-gray-300 rounded px-2 py-1 text-sm">
            <option value="">Todos</option>
            <option v-for="(mes, index) in meses" :key="index" :value="index + 1">
              {{ mes }}
            </option>
          </select>
        </div>
      </div>

      <!--botones-->
      <div class="flex justify-end mb-4">
        <div class="flex justify-center items-center flex-wrap gap-2 mb-6">
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="sortOrder === 'desc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="sortOrder = 'desc'"
          >
            Más recientes
          </button>
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="sortOrder === 'asc' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="sortOrder = 'asc'"
          >
            Más antiguos
          </button>
        </div>
      </div>
        <!-- Servicios -->
        <section class="mb-10">
          <h2 class="text-xl font-semibold mb-4 text-blue-700">Servicios</h2>
          <table class="w-full text-left border">
            <thead>
              <tr class="bg-gray-100">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Auxiliar</th>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Animal</th>
                <th class="p-2 border">Cliente</th>
                <th class="p-2 border">Precio</th>
                <th class="p-2 border"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="s in sortedServicios" :key="s.id">
                <td class="p-2 border">{{ s.id }}</td>
                <td class="p-2 border">{{ s.user?.name || 'N/A' }} {{ s.user?.apellidos || 'N/A' }}</td>
                <td class="p-2 border">{{ formatDate(s.fecha) }}</td>
                <td class="p-2 border">{{ s.animal?.nombre || 'N/A' }}</td>
                <td class="p-2 border">{{ s.animal?.user?.name || 'N/A' }} {{ s.animal?.user?.apellidos || 'N/A' }}</td>
                <td class="p-2 border">{{ s.precio }} €</td>
                <td class="border px-4 py-2">
                <div class="flex space-x-2 justify-center">
                <Link :href="route('servicios.show', s.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
             </div></td>

              </tr>
            </tbody>
          </table>
          <p class="mt-2 text-right font-semibold text-gray-700">Total Servicios: {{ totalServiciosFiltrados }} €</p>
        </section>

        <!-- Consultas -->
        <section>
          <h2 class="text-xl font-semibold mb-4 text-green-700">Consultas</h2>
          <table class="w-full text-left border">
            <thead>
              <tr class="bg-gray-100">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Veterinario</th>
                <th class="p-2 border">Fecha</th>
                <th class="p-2 border">Animal</th>
                <th class="p-2 border">Cliente</th>
                <th class="p-2 border">Precio</th>
                <th class="p-2 border"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="c in sortedConsultas" :key="c.id">
                <td class="p-2 border">{{ c.id }}</td>
                <td class="p-2 border">{{ c.user?.name || 'N/A' }} {{ c.user?.apellidos || 'N/A' }}</td>
                <td class="p-2 border">{{ formatDate(c.fecha) }}</td>
                <td class="p-2 border">{{ c.animal?.nombre || 'N/A' }}</td>
                <td class="p-2 border">{{ c.animal?.user?.name || 'N/A' }} {{ c.animal?.user?.apellidos || 'N/A' }}</td>
                <td class="p-2 border">{{ c.precio }} €</td>
                <td class="border px-4 py-2">
                <div class="flex space-x-2 justify-center">
                <Link :href="route('consultas.show', c.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
             </div></td>
              </tr>
            </tbody>
          </table>
          <p class="mt-2 text-right font-semibold text-gray-700">Total Consultas: {{ totalConsultasFiltradas }} €</p>
        </section>

        <!-- Total General -->
        <div class="mt-10 text-right text-2xl font-bold text-black">
          Total General: {{ totalGeneralFiltrado }} €
        </div>
      </div>
      <FooterWorkers />
    </AppLayout>
</template>

<script setup>
import NavBar from '@/Components/NavBar.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'
import FooterWorkers from '@/Components/FooterWorkers.vue'
import { ref, computed } from 'vue'

const props = defineProps(['servicios', 'consultas', 'totalServicios', 'totalConsultas', 'totalGeneral'])

// formato 'DD-MM-YYYY'
const formatDate = (value) => {
  if (!value) return ''
  const date = new Date(value)

  // te que ser date
  if (isNaN(date)) return 'Fecha inválida'

  const day = String(date.getDate()).padStart(2, '0')
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const year = date.getFullYear()

  return `${day}-${month}-${year}`
}
const sortOrder = ref('desc')

const sortedServicios = computed(() => {
  return [...props.servicios]
    .filter(s => {
      if (!mesSeleccionado.value) return true
      const mes = new Date(s.fecha).getMonth() + 1
      return mes === Number(mesSeleccionado.value)
    })
    .sort((a, b) => {
      return sortOrder.value === 'asc'
        ? new Date(a.fecha) - new Date(b.fecha)
        : new Date(b.fecha) - new Date(a.fecha)
    })
})

const sortedConsultas = computed(() => {
  return [...props.consultas]
    .filter(c => {
      if (!mesSeleccionado.value) return true
      const mes = new Date(c.fecha).getMonth() + 1
      return mes === Number(mesSeleccionado.value)
    })
    .sort((a, b) => {
      return sortOrder.value === 'asc'
        ? new Date(a.fecha) - new Date(b.fecha)
        : new Date(b.fecha) - new Date(a.fecha)
    })
})
const meses = [
  'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
]

const mesSeleccionado = ref('')

const totalServiciosFiltrados = computed(() => {
  return sortedServicios.value.reduce((acc, s) => acc + parseFloat(s.precio), 0)
})

const totalConsultasFiltradas = computed(() => {
  return sortedConsultas.value.reduce((acc, c) => acc + parseFloat(c.precio), 0)
})

const totalGeneralFiltrado = computed(() => {
  return totalServiciosFiltrados.value + totalConsultasFiltradas.value
})
</script>
