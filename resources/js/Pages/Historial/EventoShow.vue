<template>
    <AppLayout title="Detalles del Evento">
      <template #header>
        <NavBar />
      </template>

      <div class="max-w-4xl mx-auto p-6 mt-6 mb-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Detalles del Evento</h2>

        <div class="space-y-4">
          <div><strong>ID del evento:</strong> {{ evento.id }}</div>
          <div><strong>Título:</strong> {{ evento.title }}</div>
          <div><strong>Fecha:</strong> {{ formatDate(evento.fecha) }}</div>
          <div><strong>Tipo:</strong> {{ evento.tipo }}</div>
        </div>

        <div class="text-center mt-6">
          <Link :href="route('clients.historial.index')" class="bg-blue-600 text-white py-2 px-4 rounded-md mt-4">Volver</Link>
          <button @click="deleteEvento" class="bg-red-600 text-white py-2 px-4 rounded-md">
            Eliminar
          </button>
        </div>
      </div>
    </AppLayout>
  </template>

  <script setup>
  import NavBar from '@/Components/NavBar.vue';
  import { Link, router } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';

  const props = defineProps({
    evento: Object,
  });

  const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('es-ES', options);
  };

  const deleteEvento = () => {
    if (confirm('¿Estás seguro de que deseas eliminar este Evento?')) {
      router.delete(route('clients.historial.destroyEvento', props.evento.id), {
        onSuccess: () => {
          alert('Evento eliminada correctamente.');
        },
      });
    }
  };
  </script>
