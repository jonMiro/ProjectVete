
<template>
    <AppLayout title="Panel de Trabajadores">
        <template #header>

            <!--NavBar component-->
        <NavBar/>
        </template>



        <div class="flex justify-center mb-6">
      <input
        v-model="searchQuery"
        @input="handleSearch"
        type="text"
        class="w-1/2 p-3 rounded-lg border border-gray-300"
        placeholder="Buscar auxiliares, veterinarios, clientes, o animales..."
      />
    </div>

    <!-- grid resultados -->
    <div class="mb-6">
      <h3 class="text-center text-2xl font-semibold mt-4 mb-6">Resultados de la búsqueda</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Mostrar auxiliares -->
        <div v-if="auxiliares.length" class="col-span-1">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold mb-2">Auxiliares</h4>
            <ul>
              <li v-for="auxiliar in filteredAuxiliares" :key="auxiliar.id">
                <Link :href="route('auxiliares.show', auxiliar.id)" class="text-blue-500 hover:underline font-medium">
                  {{ auxiliar.nombre }} {{ auxiliar.apellidos }}
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mostrar veterinarios -->
        <div v-if="veterinarios.length" class="col-span-1">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold mb-2">Veterinarios</h4>
            <ul>
              <li v-for="veterinario in filteredVeterinarios" :key="veterinario.id">
                <Link :href="route('veterinarios.show', veterinario.id)" class="text-blue-500 hover:underline font-medium">
                  {{ veterinario.nombre }} {{ veterinario.apellidos }}
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mostrar clientes -->
        <div v-if="clientes.length" class="col-span-1">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold mb-2">Clientes</h4>
            <ul>
              <li v-for="cliente in filteredClientes" :key="cliente.id">
                <Link :href="route('clientes.show', cliente.id)" class="text-blue-500 hover:underline font-medium">
                  {{ cliente.nombre }} {{ cliente.apellidos }}
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <!-- Mostrar animales -->
        <div v-if="animales.length" class="col-span-1">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <h4 class="text-lg font-semibold mb-2">Animales</h4>
            <ul>
              <li v-for="animal in filteredAnimales" :key="animal.id">
                <Link :href="route('animales.show', animal.id)" class="text-blue-500 hover:underline font-medium">
                  {{ animal.nombre }}
                </Link>
              </li>
            </ul>
          </div>
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
import FooterWorkers from '@/Components/FooterWorkers.vue';


// Recibimos los props
const props = defineProps({
  search: String,
  animales: Array,
  auxiliares: Array,
  veterinarios: Array,
  clientes: Array,
});

// Estado para la búsqueda
const searchQuery = ref(props.search);

// Función de búsqueda
const handleSearch = () => {};

// Filtros computados
const filteredAnimales = computed(() => {
  return props.animales.filter(animal =>
    animal.nombre.toLowerCase().startsWith(searchQuery.value.toLowerCase())
  );
});

const filteredAuxiliares = computed(() => {
  return props.auxiliares.filter(auxiliar =>
    auxiliar.nombre.toLowerCase().startsWith(searchQuery.value.toLowerCase())
  );
});

const filteredVeterinarios = computed(() => {
  return props.veterinarios.filter(veterinario =>
    veterinario.nombre.toLowerCase().startsWith(searchQuery.value.toLowerCase())
  );
});

const filteredClientes = computed(() => {
  return props.clientes.filter(cliente =>
    cliente.nombre.toLowerCase().startsWith(searchQuery.value.toLowerCase())
  );
});
</script>

<style scoped>
/* Aquí puedes agregar cualquier estilo adicional si es necesario */
</style>
