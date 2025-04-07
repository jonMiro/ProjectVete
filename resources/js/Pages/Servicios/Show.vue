<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
  servicio: Object,
});

</script>

<template>
  <AppLayout title="Detalle del Servicio">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto mt-10 px-4">
      <h2 class="text-center text-3xl font-semibold mb-8">Detalles del Servicio</h2>

      <!-- Detalles del servicio -->
      <div class="bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
        <div class="mb-6 text-center">
          <h3 class="text-2xl font-semibold text-blue-500">ID Servicio: {{ servicio.id }}</h3>
        </div>

        <div class="mb-6 text-center">
          <p class="text-lg"><strong>Tipo de Servicio:</strong> {{ servicio.tipo_servicio }}</p>
          <p class="text-lg"><strong>Descripción:</strong> {{ servicio.descripcion }}</p>
          <p class="text-lg"><strong>Duración:</strong> {{ servicio.duracion }} minutos</p>
          <p class="text-lg"><strong>Precio:</strong> ${{ servicio.precio }}</p>
        </div>

        <!-- Información del auxiliar -->
        <div class="mb-6 text-center">
          <h4 class="text-xl font-semibold text-gray-800">Auxiliar:</h4>
          <p class="text-lg"><strong>Nombre:</strong> {{ servicio.auxiliar.nombre }} {{ servicio.auxiliar.apellidos }}</p>
          <p class="text-lg"><strong>Email:</strong> {{ servicio.auxiliar.email }}</p>
        </div>

        <!-- Información del animal -->
        <div class="mb-6 text-center">
          <h4 class="text-xl font-semibold text-gray-800">Animal:</h4>
          <p class="text-lg"><strong>Nombre:</strong> {{ servicio.animal.nombre }}</p>
          <p class="text-lg"><strong>Tipo:</strong> {{ servicio.animal.tipo }}</p>
          <p class="text-lg"><strong>Raza:</strong> {{ servicio.animal.raza }}</p>
          <p class="text-lg"><strong>Sexo:</strong> {{ servicio.animal.sexo }}</p>
        </div>
      </div>

      <!-- Enlace para regresar al listado de servicios -->
      <div class="mt-6 text-center">
        <Link :href="route('servicios.index')" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Volver al listado de Servicios</Link>
      </div>
    </div>
  </AppLayout>
</template>
