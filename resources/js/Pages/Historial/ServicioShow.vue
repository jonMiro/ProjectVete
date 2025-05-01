<script setup>
import { jsPDF } from 'jspdf';
import NavBar from '@/Components/NavBar.vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';


const props = defineProps({
  servicio: Object,
});

// Función para formatear la fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};

// Función para formatear la hora
const formatTime = (time) => {
  if (!time) return 'No disponible';
  const date = new Date(`1970-01-01T${time}Z`);
  return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
};

// Función para generar el PDF
const generatePDF = () => {
  if (!props.servicio) {
    console.error('No se encontró el servicio');
    return;
  }

  const doc = new jsPDF();

  doc.setFontSize(16);
  doc.text(`Servicio ID: ${props.servicio.id}`, 10, 10);

  doc.setFontSize(12);
  doc.text(`Tipo de Servicio: ${props.servicio.tipo_servicio}`, 10, 20);
  doc.text(`Descripción: ${props.servicio.descripcion}`, 10, 30);
  doc.text(`Duración: ${props.servicio.duracion} minutos`, 10, 40);
  doc.text(`Precio: $${props.servicio.precio}`, 10, 50);

  // Fecha y Hora
  doc.text(`Fecha: ${formatDate(props.servicio.fecha)}`, 10, 60);
  doc.text(`Hora: ${formatTime(props.servicio.hora)}`, 10, 70);

  doc.text(`Auxiliar: ${props.servicio.user.name} ${props.servicio.user.apellidos}`, 10, 80);
  doc.text(`Email Auxiliar: ${props.servicio.user.email}`, 10, 90);

  doc.text(`Animal: ${props.servicio.animal.nombre}`, 10, 100);
  doc.text(`Tipo: ${props.servicio.animal.tipo}`, 10, 110);
  doc.text(`Raza: ${props.servicio.animal.raza}`, 10, 120);
  doc.text(`Sexo: ${props.servicio.animal.sexo}`, 10, 130);

  doc.save(`servicio_${props.servicio.id}.pdf`);
};

const deleteServicio = () => {
    if (confirm('¿Estás seguro de que deseas eliminar este servicio?')) {
      router.delete(route('clients.historial.destroyServicio', props.servicio.id), {
        onSuccess: () => {
          alert('Servicio eliminada correctamente.');
        },
      });
    }
  };
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

        <!-- Fecha y Hora -->
        <div class="mb-6 text-center">
          <p class="text-lg"><strong>Fecha:</strong> {{ formatDate(servicio.fecha) }}</p>
          <p class="text-lg"><strong>Hora:</strong> {{ formatTime(servicio.hora) }}</p>
        </div>

        <!-- Información del auxiliar -->
        <div class="mb-6 text-center">
          <h4 class="text-xl font-semibold text-gray-800">Auxiliar:</h4>
          <p class="text-lg"><strong>Nombre:</strong> {{ servicio.user.name }} {{ servicio.user.apellidos }}</p>
          <p class="text-lg"><strong>Email:</strong> {{ servicio.user.email }}</p>
        </div>

        <!-- Información del animal -->
        <div class="mb-6 text-center">
          <h4 class="text-xl font-semibold text-gray-800">Animal:</h4>
          <p class="text-lg"><strong>Nombre:</strong> {{ servicio.animal.nombre }}</p>
          <p class="text-lg"><strong>Tipo:</strong> {{ servicio.animal.tipo }}</p>
          <p class="text-lg"><strong>Raza:</strong> {{ servicio.animal.raza }}</p>
          <p class="text-lg"><strong>Sexo:</strong> {{ servicio.animal.sexo }}</p>
        </div>

      <!-- Botón para generar el PDF -->
      <div class="mt-6 text-center">
        <button @click="generatePDF" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-300">
          Generar PDF
        </button>
      </div>
      </div>


      <!-- Enlace para regresar al listado de servicios -->
      <div class="mt-6 text-center">
        <Link :href="route('servicios.index')" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">
          Volver al listado de Servicios
        </Link>
        <button @click="deleteServicio" class="bg-red-600 text-white py-2 px-4 rounded-md">
            Eliminar
          </button>
      </div>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
