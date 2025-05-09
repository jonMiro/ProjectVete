<template>
    <AppLayout title="Detalles del Evento">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Próximas citas
      </h2>
      </template>

    <div class="max-w-4xl mx-auto p-6 mt-6 mb-6 bg-white shadow-xl rounded-xl">
      <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Detalles del Evento</h2>

      <div class="space-y-4">
        <div class="text-lg text-gray-700"><strong>ID del evento:</strong> {{ evento.id }}</div>
        <div class="text-lg text-gray-700"><strong>Título:</strong> {{ evento.title }}</div>
        <div class="text-lg text-gray-700"><strong>Inicio:</strong> {{ formatDateTime(evento.start) }}</div> <!-- Mostrar fecha y hora -->
        <div class="text-lg text-gray-700"><strong>Tipo:</strong> {{ evento.tipo }}</div>
        <div class="text-lg text-gray-700"><strong>Descripción:</strong> {{ evento.descripcion }}</div>
        <div class="text-lg text-gray-700"><strong>Comentario:</strong> {{ evento.comentario }}</div>
        <div class="text-lg text-gray-700"><strong>Precio:</strong> ${{ evento.precio }}</div>
      </div>

    </div>
       <!-- Botó-->
       <div class="mt-4 text-center">
          <Link :href="route('clients.historial.index')" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300">
            Volver al historial
          </Link>
        </div>
    <FooterWorkers />
  </AppLayout>
</template>

<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';


const props = defineProps({
  evento: Object,
});

// Formatear fecha y hora
const formatDateTime = (date) => {
  const options = {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  };
  return new Date(date).toLocaleDateString('es-ES', options);
};

// Eliminar evento (no funcional, no es neecesari de moment)
const deleteEvento = () => {
  if (confirm('¿Estás seguro de que deseas eliminar este Evento?')) {
    router.delete(route('clients.historial.destroyEvento', props.evento.id), {
      onSuccess: () => {
        alert('Evento eliminado correctamente.');
      },
    });
  }
};
</script>
