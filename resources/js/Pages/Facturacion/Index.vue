<template>
    <AppLayout title="Facturación">
      <template #header>
        <NavBar />
      </template>

      <div class="max-w-6xl mx-auto p-6 mt-6 bg-white shadow rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Facturación General</h1>

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
              <tr v-for="s in servicios" :key="s.id">
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
          <p class="mt-2 text-right font-semibold text-gray-700">Total Servicios: {{ totalServicios }} €</p>
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
              <tr v-for="c in consultas" :key="c.id">
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
          <p class="mt-2 text-right font-semibold text-gray-700">Total Consultas: {{ totalConsultas }} €</p>
        </section>

        <!-- Total General -->
        <div class="mt-10 text-right text-2xl font-bold text-black">
          Total General: {{ totalGeneral }} €
        </div>
      </div>
    </AppLayout>
</template>

<script setup>
import NavBar from '@/Components/NavBar.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'

defineProps(['servicios', 'consultas', 'totalServicios', 'totalConsultas', 'totalGeneral'])

// Filtro para formatear fechas en formato 'DD-MM-YYYY'
const formatDate = (value) => {
  if (!value) return ''
  const date = new Date(value)

  // Asegura que la fecha sea válida
  if (isNaN(date)) return 'Fecha inválida'

  const day = String(date.getDate()).padStart(2, '0')  // Asegura 2 dígitos para el día
  const month = String(date.getMonth() + 1).padStart(2, '0')  // Ajuste de 0 a 11 para el mes
  const year = date.getFullYear()

  return `${day}-${month}-${year}` 
}
</script>
