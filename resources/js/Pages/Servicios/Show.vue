<script setup>
import { jsPDF } from 'jspdf';
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const props = defineProps({
  servicio: Object,
});

//formatejar fecha
const formatDate = (date) => {
  if (!date) return 'No disponible';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('es-ES', options);
};

//formatejar hora
const formatTime = (time) => {
  if (!time) return 'No disponible';
  const date = new Date(`1970-01-01T${time}Z`);
  return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
};

//generar el PDF
const generatePDF = () => {
  if (!props.servicio) {
    console.error('No se encontró el servicio');
    return;
  }

  const doc = new jsPDF();

  //logo
  const logoPath = 'https://vetandcare-main-lks3tp.laravel.cloud/images/logo.webp';
  doc.addImage(logoPath, 'WEBP', 10, 10, 30, 30);

  // Títol
  doc.setFontSize(20);
  doc.text('ProjectVet', 50, 25);


  const currentDate = new Date();
  const formattedDate = currentDate.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
  const formattedTime = currentDate.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
  doc.setFontSize(10);
  doc.text(`${formattedDate} - ${formattedTime}`, 150, 25);

  // linea
  doc.setLineWidth(0.5);
  doc.line(10, 40, 200, 40);

  //auxiliar
  doc.setFontSize(12);
  doc.text(`Auxiliar: ${props.servicio.user.name} ${props.servicio.user.apellidos}`, 10, 50);
  doc.text(`Email: ${props.servicio.user.email}`, 10, 60);

  //animal
  doc.text(`Animal: ${props.servicio.animal.nombre}`, 10, 70);
  doc.text(`Tipo: ${props.servicio.animal.tipo}`, 10, 80);
  doc.text(`Raza: ${props.servicio.animal.raza}`, 10, 90);
  doc.text(`Sexo: ${props.servicio.animal.sexo}`, 10, 100);

  // espai
  doc.setLineWidth(0.5);
  doc.line(10, 110, 200, 110);

  //servici
  doc.setFontSize(16);
  doc.text(`Servicio ID: ${props.servicio.id}`, 105, 120, { align: 'center' });
  doc.setFontSize(12);
  doc.text(`Tipo de Servicio: ${props.servicio.tipo_servicio}`, 10, 130);
  doc.text(`Descripción: ${props.servicio.descripcion}`, 10, 140);
  doc.text(`Duración: ${props.servicio.duracion} minutos`, 10, 150);
  doc.text(`Precio: $${props.servicio.precio}`, 10, 160);

  // footer
  const footerY = 270;
  const footerLogoSize = 8;

  // Logo footer
  doc.addImage(logoPath, 'WEBP', 8, footerY, footerLogoSize, footerLogoSize);

  doc.setFontSize(8);
  doc.text('@2025 Vet&Care. Todos los derechos reservados.      Av Almaig 123.    Telefono:666 666 666 ', 30, footerY + 5);  // Texto

  // Guardar
  doc.save(`servicio_${props.servicio.id}.pdf`);
};


</script>

<template>
  <AppLayout title="Detalle del Servicio">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto mt-10 px-4">

      <div class=" p-6 rounded-xl shadow-xl max-w-4xl mx-auto mb-8 bg-white">
        <div class="text-center mb-6">
          <h3 class="text-2xl font-bold text-gray-800">Servicio #{{ servicio.id }}</h3>
        </div>

        <div class="mb-6">
          <p class="text-lg text-gray- text-center"><strong>Fecha:</strong> {{ formatDate(servicio.fecha) }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Hora:</strong> {{ formatTime(servicio.hora) }}</p>
        </div>

        <div class="mb-6">
          <h4 class="text-xl font-bold text-gray-800 text-center">Auxiliar:</h4>
          <p class="text-lg text-gray-700 text-center"><strong>Nombre:</strong> {{ servicio.user.name }} {{ servicio.user.apellidos }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Email:</strong> {{ servicio.user.email }}</p>
        </div>
        <div class="mb-6">
          <h4 class="text-xl font-bold text-gray-800 text-center">Animal:</h4>
          <p class="text-lg text-gray-700 text-center"><strong>Nombre:</strong> {{ servicio.animal.nombre }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Tipo:</strong> {{ servicio.animal.tipo }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Raza:</strong> {{ servicio.animal.raza }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Sexo:</strong> {{ servicio.animal.sexo }}</p>
        </div>

        <div class="mb-6">
          <p class="text-lg text-gray-700 text-center"><strong>Tipo de Servicio:</strong> {{ servicio.tipo_servicio }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Descripción:</strong> {{ servicio.descripcion }}</p>
          <p class="text-lg text-gray-700 text-center"><strong>Duración:</strong> {{ servicio.duracion }} minutos</p>
          <p class="text-lg text-gray-700 text-center"><strong>Precio:</strong> {{ servicio.precio }}€</p>
        </div>

        <div class="text-center">
          <button @click="generatePDF" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-300">Generar PDF</button>
        </div>
      </div>

      <div class="mt-6 text-center">
        <Link :href="route('servicios.index')" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">
          Volver al listado de Servicios
        </Link>
      </div>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
