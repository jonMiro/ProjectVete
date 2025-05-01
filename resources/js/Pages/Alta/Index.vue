<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import { ref } from 'vue';
import FormularioUsuario from '@/Components/FormularioUsuario.vue';
import FormularioAnimales from '@/Components/FormularioAnimales.vue';
import FormularioServicio from '@/Components/FormularioServicio.vue';
import FormularioConsulta from '@/Components/FormularioConsulta.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const currentSection = ref('usuario');

const props = defineProps({
  users: Array,
  animales: Array,
  auxiliares: Array,
  clientes: Array,
});

</script>

<template>
  <AppLayout title="Alta de Registros">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto mt-10 px-4">
      <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">Gestión de Altas</h1>

      <!-- Nav de secciones -->
      <div class="flex justify-center space-x-4 mb-8">
        <button @click="currentSection = 'usuario'" class="px-4 py-2 rounded bg-blue-200 hover:bg-blue-300">Usuario</button>
        <button @click="currentSection = 'animal'" class="px-4 py-2 rounded bg-blue-200 hover:bg-blue-300">Animal</button>
        <button @click="currentSection = 'servicio'" class="px-4 py-2 rounded bg-blue-200 hover:bg-blue-300">Servicio</button>
        <button @click="currentSection = 'consulta'" class="px-4 py-2 rounded bg-blue-200 hover:bg-blue-300">Consulta</button>
      </div>

      <!-- Seccions-->
      <div v-if="currentSection === 'usuario'">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Formulario de Alta Usuario</h2>
        <FormularioUsuario />
      </div>

      <div v-else-if="currentSection === 'animal'">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Formulario de Alta Animal</h2>
        <FormularioAnimales :clientes="clientes" />
      </div>

      <div v-else-if="currentSection === 'servicio'">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Formulario de Alta Servicio</h2>
        <FormularioServicio :users="users" :animales="animales" :auxiliares="auxiliares"/>
      </div>

      <div v-else-if="currentSection === 'consulta'">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Formulario de Alta Consulta</h2>
        <FormularioConsulta :users="users" :animales="animales" />
      </div>

    </div>
    <FooterWorkers />
  </AppLayout>
</template>
