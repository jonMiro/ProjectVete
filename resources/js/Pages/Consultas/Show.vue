<template>
    <AppLayout title="Detalles de la Consulta">
      <template #header>
        <NavBar />
      </template>

      <div class="max-w-4xl mx-auto p-6 mt-6 mb-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Consulta</h2>

        <!-- Consulta -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
          <span><strong class="font-semibold">ID de la consulta:</strong> {{ consulta?.id ?? 'No disponible' }}</span>
          <span><strong class="font-semibold">Fecha:</strong> {{ formatDate(consulta?.fecha) }}</span>
          <span><strong class="font-semibold">Hora:</strong> {{ consulta?.hora ?? 'No disponible' }}</span>
          <span><strong class="font-semibold">Lugar:</strong> {{ consulta?.lugar ?? 'No disponible' }}</span>
          <span><strong class="font-semibold">Peso:</strong> {{ consulta?.peso ?? 'No disponible' }} kg</span>
          <span>
            <strong class="font-semibold">Veterinario:</strong>
            {{ consulta?.user ? `${consulta.user.name} ${consulta.user.apellidos}` : 'N/A' }}
          </span>
          <span>
            <strong class="font-semibold">Animal:</strong>
            {{ consulta?.animal?.nombre ?? 'N/A' }} (ID: {{ consulta?.animal?.id ?? 'N/A' }})
          </span>
          <span><strong class="font-semibold">Tipo de animal:</strong> {{ consulta?.tipo_animal ?? 'No disponible' }}</span>
          <span><strong class="font-semibold">Raza:</strong> {{ consulta?.raza ?? 'No disponible' }}</span>
        </div>

        <div class="mt-6 space-y-3 text-gray-700">
          <p><strong class="font-semibold">Motivo:</strong> {{ consulta?.motivo ?? 'No disponible' }}</p>
          <p><strong class="font-semibold">Anamnesis:</strong> {{ consulta?.anamnesis ?? 'No disponible' }}</p>
          <p><strong class="font-semibold">Examen físico:</strong> {{ consulta?.examen_fisico ?? 'No disponible' }}</p>
          <p><strong class="font-semibold">Diagnóstico:</strong> {{ consulta?.diagnostico ?? 'No disponible' }}</p>
          <p><strong class="font-semibold">Tratamiento:</strong> {{ consulta?.tratamiento ?? 'No disponible' }}</p>
          <p><strong class="font-semibold">Observaciones:</strong> {{ consulta?.observaciones ?? 'No disponible' }}</p>
          <p><strong class="font-semibold">Precio:</strong> {{ consulta?.precio ?? 'No disponible' }} €</p>
        </div>

        <!-- Botón para generar el PDF -->
        <div class="mt-6 text-center">
          <button @click="generatePDF" class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-300">
            Generar PDF
          </button>
        </div>


      </div>
       <!-- Botón para volver -->
       <div class="mt-4 text-center">
          <Link :href="route('consultas.index')" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Volver al listado de consultas
          </Link>
        </div>

      <FooterWorkers />
    </AppLayout>
  </template>


  <script setup>
  import { jsPDF } from 'jspdf';
  import NavBar from '@/Components/NavBar.vue';
  import { Link } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import FooterWorkers from '@/Components/FooterWorkers.vue';

  const props = defineProps({
    consulta: Object,
  });

  //formatejar fecha
  const formatDate = (date) => {
    if (!date) return 'No disponible';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('es-ES', options);
  };


  // Generar el PDF
  const generatePDF = () => {
    if (!props.consulta) {
      console.error('No se encontró la consulta');
      return;
    }

    const doc = new jsPDF();

    //logo
    const logoPath = 'http://localhost:8000/images/logo.webp';
    doc.addImage(logoPath, 'WEBP', 10, 10, 30, 30);

    // Títol
    doc.setFontSize(20);
    doc.text('ProjectVet', 50, 25);

    const currentDate = new Date();
    const formattedDate = currentDate.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
    const formattedTime = currentDate.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
    doc.setFontSize(10);
    doc.text(`${formattedDate} - ${formattedTime}`, 150, 25);

    // espai
doc.setLineWidth(0.5);
doc.line(10, 40, 200, 40);

doc.setFontSize(12);

// detalls
doc.text(`Lugar: ${props.consulta.lugar}`, 10, 50);
doc.text(`Peso: ${props.consulta.peso} kg`, 10, 60);
doc.text(`Veterinario: ${props.consulta.user ? props.consulta.user.name + ' ' + props.consulta.user.apellidos : 'N/A'}`, 10, 70);
doc.text(`Animal: ${props.consulta.animal ? props.consulta.animal.nombre : 'N/A'}`, 10, 80);
doc.text(`Motivo: ${props.consulta.motivo}`, 10, 90);
doc.text(`Anamnesis: ${props.consulta.anamnesis}`, 10, 100);
doc.text(`Examen físico: ${props.consulta.examen_fisico}`, 10, 110);
doc.text(`Diagnóstico: ${props.consulta.diagnostico}`, 10, 120);
doc.text(`Tratamiento: ${props.consulta.tratamiento}`, 10, 130);
doc.text(`Observaciones: ${props.consulta.observaciones}`, 10, 140);
doc.text(`Precio: ${props.consulta.precio} €`, 10, 150);

    // footer
    const footerY = 270;
    const footerLogoSize = 10;
    doc.addImage(logoPath, 'WEBP', 10, footerY, footerLogoSize, footerLogoSize);

    doc.setFontSize(8);
    doc.text('@2025 Vet&Care. Todos los derechos reservados.      Av Almaig 123.    Telefono:666 666 666 ', 30, footerY + 5);  // Texto

    // Guardar
    doc.save(`consulta_${props.consulta.id}.pdf`);
  };

  </script>
