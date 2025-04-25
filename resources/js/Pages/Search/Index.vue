<template>
    <AppLayout title="Panel de Servicios">
      <template #header>
        <NavBar />
      </template>

      <!-- Buscador -->
      <div class="flex justify-center mt-8">
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          class="w-1/2 p-3 border border-gray-300 rounded-lg"
          placeholder="Buscar usuarios, clientes, animales o servicios..."
        />
      </div>

      <!-- Resultados filtrados debajo del buscador -->
      <div v-if="searchQuery" class="mt-6">
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
          <h4 class="text-lg font-semibold mb-4 text-center">Resultados de búsqueda</h4>
          <ul class="list-none p-0">
            <!-- Veterinarios -->
            <li v-if="filteredVeterinarios.length" class="mb-4">
              <h5 class="text-lg font-semibold text-center">Veterinarios</h5>
              <ul>
                <li v-for="veterinario in filteredVeterinarios" :key="veterinario.id" class="mb-2 text-center">
                  <Link :href="veterinario.route" class="text-blue-600 hover:underline font-semibold">
                    {{ veterinario.name }} {{ veterinario.apellidos }}
                  </Link>
                </li>
              </ul>
            </li>

            <!-- Auxiliares -->
            <li v-if="filteredAuxiliares.length" class="mb-4">
              <h5 class="text-lg font-semibold text-center">Auxiliares</h5>
              <ul>
                <li v-for="auxiliar in filteredAuxiliares" :key="auxiliar.id" class="mb-2 text-center">
                  <Link :href="auxiliar.route" class="text-blue-600 hover:underline font-semibold">
                    {{ auxiliar.name }} {{ auxiliar.apellidos }}
                  </Link>
                </li>
              </ul>
            </li>

            <!-- Clientes -->
            <li v-if="filteredClientes.length" class="mb-4">
              <h5 class="text-lg font-semibold text-center">Clientes</h5>
              <ul>
                <li v-for="cliente in filteredClientes" :key="cliente.id" class="mb-2 text-center">
                  <Link :href="cliente.route" class="text-blue-600 hover:underline font-semibold">
                    {{ cliente.name }} {{ cliente.apellidos }}
                  </Link>
                </li>
              </ul>
            </li>

            <!-- Animales -->
            <li v-if="filteredAnimales.length" class="mb-4">
              <h5 class="text-lg font-semibold text-center">Animales</h5>
              <ul>
                <li v-for="animal in filteredAnimales" :key="animal.id" class="mb-2 text-center">
                  <Link :href="animal.route" class="text-blue-600 hover:underline font-semibold">
                    {{ animal.nombre }}
                  </Link>
                </li>
              </ul>
            </li>

            <!-- Servicios -->
            <li v-if="filteredServicios.length" class="mb-4">
              <h5 class="text-lg font-semibold text-center">Servicios</h5>
              <ul>
                <li v-for="servicio in filteredServicios" :key="servicio.id" class="mb-2 text-center">
                  <Link :href="servicio.route" class="text-blue-600 hover:underline font-semibold">
                    {{ servicio.tipo_servicio }}
                  </Link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>

      <!-- resultados cuando no se está buscando -->
      <div v-if="!searchQuery" class="mt-10 mb-6">
        <div class="container mx-auto px-4">
          <!-- Mostrar resultados agrupados por tipo -->
          <div v-if="filteredVeterinarios.length" class="mb-6">
            <h4 class="text-lg font-semibold text-center">Veterinarios</h4>
            <ul class="list-none p-0">
              <li v-for="veterinario in filteredVeterinarios" :key="veterinario.id" class="mb-2 text-center">
                <Link :href="veterinario.route" class="text-blue-600 hover:underline font-semibold">
                  {{ veterinario.name }} {{ veterinario.apellidos }}
                </Link>
              </li>
            </ul>
          </div>

          <div v-if="filteredAuxiliares.length" class="mb-6">
            <h4 class="text-lg font-semibold text-center">Auxiliares</h4>
            <ul class="list-none p-0">
              <li v-for="auxiliar in filteredAuxiliares" :key="auxiliar.id" class="mb-2 text-center">
                <Link :href="auxiliar.route" class="text-blue-600 hover:underline font-semibold">
                  {{ auxiliar.name }} {{ auxiliar.apellidos }}
                </Link>
              </li>
            </ul>
          </div>

          <div v-if="filteredClientes.length" class="mb-6">
            <h4 class="text-lg font-semibold text-center">Clientes</h4>
            <ul class="list-none p-0">
              <li v-for="cliente in filteredClientes" :key="cliente.id" class="mb-2 text-center">
                <Link :href="cliente.route" class="text-blue-600 hover:underline font-semibold">
                  {{ cliente.name }} {{ cliente.apellidos }}
                </Link>
              </li>
            </ul>
          </div>

          <div v-if="filteredAnimales.length" class="mb-6">
            <h4 class="text-lg font-semibold text-center">Animales</h4>
            <ul class="list-none p-0">
              <li v-for="animal in filteredAnimales" :key="animal.id" class="mb-2 text-center">
                <Link :href="animal.route" class="text-blue-600 hover:underline font-semibold">
                  {{ animal.nombre }}
                </Link>
              </li>
            </ul>
          </div>

          <div v-if="filteredServicios.length" class="mb-6">
            <h4 class="text-lg font-semibold text-center">Servicios</h4>
            <ul class="list-none p-0">
              <li v-for="servicio in filteredServicios" :key="servicio.id" class="mb-2 text-center">
                <Link :href="servicio.route" class="text-blue-600 hover:underline font-semibold">
                  {{ servicio.tipo_servicio }}
                </Link>
              </li>
            </ul>
          </div>
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
    clientes: { type: Array, default: () => [] },
    veterinarios: { type: Array, default: () => [] },
    auxiliares: { type: Array, default: () => [] },
    animales: { type: Array, default: () => [] },
    servicios: { type: Array, default: () => [] },
    search: { type: String, default: '' },
  });

  const searchQuery = ref(props.search);

  const handleSearch = () => {};

  // Filtros por tipo de usuario
  const filteredClientes = computed(() => {
  return props.clientes
    .filter(user =>
      user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
    .map(user => ({
      ...user,
      route: route('users.show', user.id),
    }));
});

const filteredVeterinarios = computed(() => {
  return props.veterinarios
    .filter(user =>
      user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
    .map(user => ({
      ...user,
      route: route('users.show', user.id),
    }));
});

const filteredAuxiliares = computed(() => {
  return props.auxiliares
    .filter(user =>
      user.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
    .map(user => ({
      ...user,
      route: route('users.show', user.id),
    }));
});

const filteredAnimales = computed(() => {
  return props.animales
    .filter(animal =>
      animal.nombre.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
    .map(animal => ({
      ...animal,
      route: route('animales.show', animal.id),
    }));
});

const filteredServicios = computed(() => {
  return props.servicios
    .filter(servicio =>
      servicio.tipo_servicio.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
    .map(servicio => ({
      ...servicio,
      route: route('servicios.show', servicio.id),
    }));
});


  // Resultados combinados
  const filteredResults = computed(() => {
    const combinedResults = [
      ...filteredClientes.value,
      ...filteredVeterinarios.value,
      ...filteredAuxiliares.value,
      ...filteredAnimales.value,
      ...filteredServicios.value,
    ];

    return combinedResults.map(item => {
      if (item.name) {
        return { ...item, route: '#' }; // Ajusta la ruta según corresponda
      }
      if (item.nombre) {
        return { ...item, route: route('animales.show', item.id) };
      }
      if (item.tipo_servicio) {
        return { ...item, route: route('servicios.show', item.id) };
      }
    });
  });
  </script>

  <style scoped>
  /* Puedes eliminar el CSS personalizado ya que todo está cubierto por Tailwind */
  </style>
