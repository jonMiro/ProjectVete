<template>
    <AppLayout title="Detalles de la Consulta">
      <template #header>
        <NavBar />
      </template>

      <div class="max-w-4xl mx-auto p-6 mt-6 mb-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Detalles de la Consulta</h2>

        <div class="space-y-4">
          <div><strong>ID de la consulta:</strong> {{ consulta.id }}</div>
          <div><strong>Fecha:</strong> {{ formatDate(consulta.fecha) }}</div>
          <div><strong>Hora:</strong> {{ consulta.hora }}</div>
          <div><strong>Lugar:</strong> {{ consulta.lugar }}</div>
          <div><strong>Veterinario:</strong> {{ consulta.user.name }}</div>
          <div><strong>Animal:</strong> {{ consulta.animal.nombre }} (ID: {{ consulta.animal.id }})</div>
          <div><strong>Motivo:</strong> {{ consulta.motivo }}</div>
          <div><strong>Anamnesis:</strong> {{ consulta.anamnesis }}</div>
          <div><strong>Diagnóstico:</strong> {{ consulta.diagnostico }}</div>
          <div><strong>Tratamiento:</strong> {{ consulta.tratamiento }}</div>
          <div><strong>Precio:</strong> {{ consulta.precio }} €</div>
        </div>

        <div class="text-center mt-6 space-x-4">
          <button @click="generatePDF" class="bg-green-600 text-white py-2 px-4 rounded-md">
            Generar PDF
          </button>
          <Link :href="route('clients.historial.index')" class="bg-blue-600 text-white py-2 px-4 rounded-md">
            Volver
          </Link>
          <button @click="deleteConsulta" class="bg-red-600 text-white py-2 px-4 rounded-md">
            Eliminar
          </button>
        </div>
      </div>
    </AppLayout>
  </template>

  <script setup>
  import { ref } from 'vue';
  import { jsPDF } from 'jspdf';
  import NavBar from '@/Components/NavBar.vue';
  import { Link, router } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';

  const props = defineProps({
    consulta: Object,
  });

  const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('es-ES', options);
  };

  const generatePDF = () => {
    const doc = new jsPDF();
    doc.text(`Consulta ID: ${props.consulta.id}`, 10, 10);
    doc.text(`Fecha: ${formatDate(props.consulta.fecha)}`, 10, 20);
    doc.text(`Hora: ${props.consulta.hora}`, 10, 30);
    doc.save(`consulta_${props.consulta.id}.pdf`);
  };

  const deleteConsulta = () => {
    if (confirm('¿Estás seguro de que deseas eliminar esta consulta?')) {
      router.delete(route('clients.historial.destroyConsulta', props.consulta.id), {
        onSuccess: () => {
          alert('Consulta eliminada correctamente.');
        },
      });
    }
  };
  </script>
