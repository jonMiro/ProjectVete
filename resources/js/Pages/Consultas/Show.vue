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
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
  <div><strong>ID de la consulta:</strong> {{ consulta ? consulta.id : 'No disponible' }}</div>
  <div><strong>Fecha:</strong> {{ formatDate(consulta ? consulta.fecha : 'No disponible') }}</div>
  <div><strong>Hora:</strong> {{ consulta ? consulta.hora : 'No disponible' }}</div>
</div>
</div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><strong>Lugar:</strong> {{ consulta ? consulta.lugar : 'No disponible' }}</div>
            <div><strong>Peso:</strong> {{ consulta ? consulta.peso : 'No disponible' }} kg</div>
            <div>
              <strong>Veterinario:</strong>
              {{ consulta && consulta.veterinario ? consulta.veterinario.nombre + ' ' + consulta.veterinario.apellidos : 'N/A' }}
            </div>
            <div><strong>Animal:</strong> {{ consulta && consulta.animal ? consulta.animal.nombre : 'N/A' }} (ID: {{ consulta && consulta.animal ? consulta.animal.id : 'N/A' }})</div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div><strong>Tipo de animal:</strong> {{ consulta ? consulta.tipo_animal : 'No disponible' }}</div>
            <div><strong>Raza:</strong> {{ consulta ? consulta.raza : 'No disponible' }}</div>
          </div>

          <div><strong>Motivo:</strong> {{ consulta ? consulta.motivo : 'No disponible' }}</div>
          <div><strong>Anamnesis:</strong> {{ consulta ? consulta.anamnesis : 'No disponible' }}</div>
          <div><strong>Examen físico:</strong> {{ consulta ? consulta.examen_fisico : 'No disponible' }}</div>
          <div><strong>Diagnóstico:</strong> {{ consulta ? consulta.diagnostico : 'No disponible' }}</div>
          <div><strong>Tratamiento:</strong> {{ consulta ? consulta.tratamiento : 'No disponible' }}</div>
          <div><strong>Observaciones:</strong> {{ consulta ? consulta.observaciones : 'No disponible' }}</div>

          <!-- Precio -->
          <div><strong>Precio:</strong> {{ consulta ? consulta.precio : 'No disponible' }} €</div>
        </div>

        <!-- Botón para generar el PDF -->
        <div class="mt-6 text-center">
          <button @click="generatePDF" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-300">
            Generar PDF
          </button>
        </div>

        <!-- Botón para volver a la lista de consultas -->
        <div class="mt-6 text-center">
          <Link :href="route('consultas.index')" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Volver a la lista de consultas
          </Link>
        </div>
      </div>
    </AppLayout>
  </template>
  
<script setup>
import { jsPDF } from 'jspdf';
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

// Recibimos la propiedad consulta
const props = defineProps({
  consulta: Object,
});

// Función para formatear la fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};

// Función para generar el PDF
const generatePDF = () => {
  if (!props.consulta) {
    console.error('No se encontró la consulta');
    return;
  }

  const doc = new jsPDF();  // Instancia PDF
  // Establecemos el título
  doc.setFontSize(16);
  doc.text(`Consulta ID: ${props.consulta.id}`, 10, 10);

  // Agregamos la fecha de la consulta
  doc.text(`Fecha: ${formatDate(props.consulta.fecha)}`, 10, 20);

  // Agregamos la hora de la consulta
  const hora = props.consulta.hora || 'No disponible';
  doc.text(`Hora: ${hora}`, 10, 30);

  // Agregamos los detalles de la consulta
  doc.setFontSize(12);
  doc.text(`Lugar: ${props.consulta.lugar}`, 10, 40);
  doc.text(`Peso: ${props.consulta.peso} kg`, 10, 50);
  doc.text(`Veterinario: ${props.consulta.veterinario ? props.consulta.veterinario.nombre + ' ' + props.consulta.veterinario.apellidos : 'N/A'}`, 10, 60);
  doc.text(`Animal: ${props.consulta.animal ? props.consulta.animal.nombre : 'N/A'}`, 10, 70);
  doc.text(`Motivo: ${props.consulta.motivo}`, 10, 80);
  doc.text(`Anamnesis: ${props.consulta.anamnesis}`, 10, 90);
  doc.text(`Examen físico: ${props.consulta.examen_fisico}`, 10, 100);
  doc.text(`Diagnóstico: ${props.consulta.diagnostico}`, 10, 110);
  doc.text(`Tratamiento: ${props.consulta.tratamiento}`, 10, 120);
  doc.text(`Observaciones: ${props.consulta.observaciones}`, 10, 130);

  // Agregamos el precio de la consulta
  doc.text(`Precio: ${props.consulta.precio} €`, 10, 140);

  // Guardamos el PDF
  doc.save(`consulta_${props.consulta.id}.pdf`);
};

</script>
