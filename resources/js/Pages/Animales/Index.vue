
<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import { ref } from 'vue';

defineProps({
  animales: Array,
});

// Tabla/grid
const isListView = ref(false);

//formatejar fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};
</script>

<template>
  <AppLayout title="Panel de Animales">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto mt-2 px-4 mb-6">
      <!-- Toggle vista -->
      <div class="flex items-center mb-6">
        <label for="toggle-view" class="mr-2 text-md">Modo de vista</label>
        <input
          type="checkbox"
          id="toggle-view"
          v-model="isListView"
          class="h-4 w-4"
        />
      </div>

      <h2 class="text-center text-3xl font-semibold text-gray-700 mb-6 mt-6">Listado de Animales</h2>

      <!-- Vista Tarjeta -->
      <div v-if="isListView && animales.length > 0" class="grid gap-4">
        <div v-for="animal in animales" :key="animal.id"
          class="bg-gradient-to-br from-blue-50 to-white shadow-xl rounded-xl overflow-hidden hover:shadow-2xl transition duration-300 flex">

          <!-- Link al div -->
          <Link :href="route('animales.show', animal.id)" class="w-full flex">

            <!-- Datos -->
            <div class="p-4 w-3/5 pl-6 space-y-1">
              <h5 class="text-lg font-semibold text-blue-700 uppercase tracking-wide">{{ animal.nombre }} #{{ animal.id }}</h5>
              <p class="text-gray-700"><strong>Nombre:</strong> {{ animal.nombre }}</p>
              <p class="text-gray-700"><strong>Tipo:</strong> {{ animal.tipo }}</p>
              <p class="text-gray-700"><strong>Raza:</strong> {{ animal.raza }}</p>
              <p class="text-gray-700"><strong>Sexo:</strong> {{ animal.sexo }}</p>
              <p class="text-gray-700"><strong>Fecha Nac.:</strong> {{ formatDate(animal.fechaNacimiento) }}</p>
              <p class="text-gray-700"><strong>Cliente:</strong> {{ animal.user.name }} {{ animal.user.apellidos }}</p>
            </div>

            <!-- Imagen -->
            <div v-if="animal.imagen" class="w-2/5 flex items-center justify-center pr-4">
              <img :src="animal.imagen" alt="Imagen del animal"
                class="rounded-lg max-h-48 object-cover w-full shadow-md" />
            </div>
          </Link>
        </div>
      </div>

      <!-- Vista Tabla -->
      <div v-else-if="!isListView && animales.length > 0">
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID Animal</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Nombre</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Tipo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Raza</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Sexo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Fecha Nacimiento</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Cliente</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="animal in animales" :key="animal.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ animal.id }}</td>
              <td class="border px-4 py-2">{{ animal.nombre }}</td>
              <td class="border px-4 py-2">{{ animal.tipo }}</td>
              <td class="border px-4 py-2">{{ animal.raza }}</td>
              <td class="border px-4 py-2">{{ animal.sexo }}</td>
              <td class="border px-4 py-2">{{ formatDate(animal.fechaNacimiento) }}</td>
              <td class="border px-4 py-2">{{ animal.user.name }} {{ animal.user.apellidos }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('animales.show', animal.id)" class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200">Mostrar</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Sin animales -->
      <p v-else class="text-center text-lg text-gray-500">No hay animales registrados.</p>
    </div>

    <FooterWorkers />
  </AppLayout>
</template>
