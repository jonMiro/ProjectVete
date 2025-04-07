<template>
    <AppLayout title="Detalles de la Consulta">
      <template #header>
        <NavBar />
      </template>

      <div class="max-w-4xl mx-auto p-6 mt-6 mb-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Detalles de la Consulta</h2>

        <!-- Mostrar los datos de la consulta -->
        <div class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><strong>ID de la consulta:</strong> {{ consulta.id }}</div>
            <div><strong>Fecha:</strong> {{ consulta.fecha }}</div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><strong>Lugar:</strong> {{ consulta.lugar }}</div>
            <div><strong>Peso:</strong> {{ consulta.peso }} kg</div>
            <div>
         <strong>Veterinario:</strong>
           {{ consulta.veterinario ? consulta.veterinario.nombre + ' ' + consulta.veterinario.apellidos : 'N/A' }}
        </div>
          <div><strong>Animal:</strong> {{ consulta.animal ? consulta.animal.nombre : 'N/A' }} (ID: {{ consulta.animal ? consulta.animal.id : 'N/A' }})</div>

          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div><strong>Tipo de animal:</strong> {{ consulta.tipo_animal }}</div>
            <div><strong>Raza:</strong> {{ consulta.raza }}</div>
          </div>

          <div><strong>Motivo:</strong> {{ consulta.motivo }}</div>
          <div><strong>Anamnesis:</strong> {{ consulta.anamnesis }}</div>
          <div><strong>Examen físico:</strong> {{ consulta.examen_fisico }}</div>
          <div><strong>Diagnóstico:</strong> {{ consulta.diagnostico }}</div>
          <div><strong>Tratamiento:</strong> {{ consulta.tratamiento }}</div>
          <div><strong>Observaciones:</strong> {{ consulta.observaciones }}</div>

       </div>

        <!-- Botón para volver a la lista de consultas -->
        <div class="mt-6 text-center">
          <Link :href="route('consultas.index')" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">Volver a la lista de consultas</Link>
        </div>
      </div>
    </AppLayout>
  </template>

  <script setup>
  import NavBar from '@/Components/NavBar.vue';
  import { Link } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';

  defineProps({
    consulta: Object,  // Recibimos los datos de la consulta directamente
  });
  </script>

  <style scoped>
  /* Estilos adicionales para la vista de la consulta */
  h2 {
    font-family: 'Roboto', sans-serif;
    color: #2d3748;
  }

  strong {
    color: #2d3748;
  }

  p {
    font-size: 1rem;
    color: #4a5568;
    line-height: 1.5;
  }

  .bg-white {
    background-color: #ffffff;
  }

  .shadow-md {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .rounded-lg {
    border-radius: 8px;
  }

  .mt-6 {
    margin-top: 1.5rem;
  }

  .text-center {
    text-align: center;
  }

  .transition {
    transition: background-color 0.3s ease;
  }

  .hover\:bg-blue-700:hover {
    background-color: #2b6cb0;
  }

  .bg-blue-600 {
    background-color: #3182ce;
  }

  .text-white {
    color: white;
  }
  </style>
