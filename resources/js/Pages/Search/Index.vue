<template>
    <AppLayout title="Panel de Servicios">
      <template #header>
        <NavBar />
      </template>

      <!-- Buscador -->
      <div class="search-container">
        <input
          v-model="searchQuery"
          @input="handleSearch"
          type="text"
          class="form-control search-input"
          placeholder="Buscar usuarios, clientes, animales o servicios..."
        />
      </div>

      <!-- grid resultados -->
      <div class="results mb-6">
        <h3 class="text-center mt-4 mb-4">DataBase</h3>
        <div class="container">
          <div class="row justify-content-center">

            <!-- Mostrar clientes -->
            <div v-if="clientes.length" class="col-12 col-md-6 col-lg-3 mb-4">
              <div class="grid-item">
                <h4>Clientes</h4>
                <ul>
                  <li v-for="cliente in filteredClientes" :key="cliente.id">
                    <Link href="" class="custom-link">
                      {{ cliente.nombre }} {{ cliente.apellidos }}
                    </Link>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Mostrar animales -->
            <div v-if="animales.length" class="col-12 col-md-6 col-lg-3 mb-4">
              <div class="grid-item">
                <h4>Animales</h4>
                <ul>
                  <li v-for="animal in filteredAnimales" :key="animal.id">
                    <Link :href="route('animales.show', animal.id)" class="custom-link">
                      {{ animal.nombre }}
                    </Link>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Mostrar servicios -->
            <div v-if="servicios.length" class="col-12 col-md-6 col-lg-3 mb-4">
              <div class="grid-item">
                <h4>Servicios</h4>
                <ul>
                  <li v-for="servicio in filteredServicios" :key="servicio.id">
                    <Link :href="route('servicios.show', servicio.id)" class="custom-link">
                      {{ servicio.tipo_servicio }}
                    </Link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
    </AppLayout>
  </template>

  <script setup>
  import { ref, computed } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';
 import AppLayout from '@/Layouts/AppLayout.vue';
 import NavBar from '@/Components/NavBar.vue';

  // Pasem els props
  const props = defineProps({
    clientes: Array,
    animales: Array,
    servicios: Array,
    search: String,
  });

  const searchQuery = ref(props.search); //El ref actualitza els resultats de forma dinamica sense recarregar

  const handleSearch = () => {};

  // Filtres computed. Utilitzem filter y lowercase.El computed fa que siga reactiu, j (jon, juan), o (jon)


  const filteredClientes = computed(() => {
    return props.clientes.filter(cliente =>
      cliente.nombre.toLowerCase().startsWith(searchQuery.value.toLowerCase())
    );
  });

  const filteredAnimales = computed(() => {
    return props.animales.filter(animal =>
      animal.nombre.toLowerCase().startsWith(searchQuery.value.toLowerCase())
    );
  });

  const filteredServicios = computed(() => {
    return props.servicios.filter(servicio =>
      servicio.tipo_servicio.toLowerCase().startsWith(searchQuery.value.toLowerCase())
    );
  });
  </script>

  <style scoped>
  .search-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .search-input {
    width: 50%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
  }

  .results {
    margin-top: 20px;
  }

  .grid-item {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
  }

  .custom-link {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
  }

  .custom-link:hover {
    text-decoration: underline;
    color: #0056b3;
  }
  </style>
