<template>
    <AppLayout title="Panel de Servicios">
      <template #header>
        <NavBar />
      </template>

      <!-- Controles -->
      <div class="flex flex-col items-center mt-8 space-y-4">
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          class="w-1/2 p-3 border border-gray-300 rounded-lg"
          placeholder="Buscar usuarios, clientes, animales..."
        />
        <label class="inline-flex items-center space-x-2">
          <input
            type="checkbox"
            v-model="mostrarTodos"
            class="form-checkbox h-5 w-5 text-blue-600"
          />
          <span class="text-gray-700 text-sm">Mostrar todos los registros</span>
        </label>
      </div>

      <!-- Tabla de Resultados -->
      <div v-if="mostrarTodos || searchQuery" class="mt-10 px-4">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 border rounded-lg shadow-sm bg-white">
            <thead class="bg-gray-100">
              <tr class="text-left text-sm font-semibold text-gray-700">
                <th class="px-6 py-3">Tipo</th>
                <th class="px-6 py-3">Nombre</th>
                <th class="px-6 py-3">Telefono</th>
                <th class="px-6 py-3">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr
                v-for="item in filteredResults"
                :key="item.id + item.tipo"
                class="hover:bg-gray-50 text-sm"
              >
                <td class="px-6 py-4 font-medium">
                  {{ item.tipo }}
                </td>
                <td class="px-6 py-4">
                  {{ item.nombre_completo }}
                </td>
                <td class="px-6 py-4">
                  {{ item.telefono }}
                </td>
                <td class="px-6 py-4">
                  <Link
                    :href="item.route"
                    class="text-blue-600 hover:underline"
                  >
                    Ver detalles
                  </Link>
                </td>
              </tr>
              <tr v-if="filteredResults.length === 0">
                <td colspan="3" class="text-center py-4 text-gray-500">
                  No se encontraron resultados.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AppLayout>
  </template>

  <script setup>
  import { ref, computed } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import NavBar from '@/Components/NavBar.vue';

  const props = defineProps({
    clientes: Array,
    veterinarios: Array,
    auxiliares: Array,
    animales: Array,
    search: String,
  });

  const searchQuery = ref(props.search || '');
  const mostrarTodos = ref(false);
  const handleSearch = () => {};

  // Unificar y etiquetar todos los resultados
  const filteredResults = computed(() => {
  const query = searchQuery.value.toLowerCase();

  const format = (items, tipo, nombreKey, routeName) =>
    items
      .map(i => ({
        ...i,
        tipo,
        nombre_completo: `${i[nombreKey] || ''} ${i.apellidos || ''}`.trim(),
        route: route(routeName, i.id),
      }))
      .filter(i => query === '' || i.nombre_completo.toLowerCase().includes(query));

  const allItems = [
    ...format(props.clientes, 'Cliente', 'name', 'users.show'),
    ...format(props.veterinarios, 'Veterinario', 'name', 'users.show'),
    ...format(props.auxiliares, 'Auxiliar', 'name', 'users.show'),
    ...format(props.animales, 'Animal', 'nombre', 'animales.show'),
  ];

  return mostrarTodos.value || query !== ''
    ? allItems
    : [];
});
  </script>
