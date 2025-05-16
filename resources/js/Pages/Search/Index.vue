<template>
    <AppLayout title="Panel de Servicios">
      <template #header>
        <NavBar />
      </template>

      <div class="flex justify-between items-center px-4 mt-6">
        <!-- Enlaces-->
        <div class="flex flex-col space-y-2">
          <Link :href="route('animales.index')" class="text-sm text-blue-600 hover:underline">
            Listado animales
          </Link>
          <Link :href="route('users.index')" class="text-sm text-blue-600 hover:underline">
            Listado usuarios
          </Link>
          <Link :href="route('postsworkers.index')" class="text-sm text-blue-600 hover:underline">
            Listado posts
          </Link>
        </div>
      </div>

      <!-- buscador -->
      <div class="flex justify-center -mt-16">
        <div class="w-full max-w-lg">
          <input
            v-model="searchQuery"
            @input="handleSearch"
            type="text"
            class="w-full p-3 border border-gray-300 rounded-lg"
            placeholder="Buscar usuarios, clientes, animales..."
          />
          <label class="inline-flex items-center text-center space-x-2 mt-4">
            <input
              type="checkbox"
              v-model="mostrarTodos"
              class="form-checkbox h-5 w-5 text-blue-600"
            />
            <span class="text-gray-700 text-sm">Mostrar todos los registros</span>
          </label>
        </div>
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
