<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  title: '',
  fecha: '',
  start: '',
  end: '',
  tipo: '',
  descripcion: '',
  comentario: '',
  precio: '',
});


</script>

<template>
  <AppLayout title="Nuevo Evento">
    <template #header>
      <NavBar />
    </template>

    <div class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-lg shadow mt-8">
      <h2 class="text-2xl font-bold text-center mb-8">Crear Nuevo Evento</h2>

      <form @submit.prevent="form.post(route('eventos.store'))" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Título -->
        <div class="md:col-span-2">
          <label class="block mb-1 font-semibold">Título</label>
          <input type="text" v-model="form.title" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Fecha -->
        <div>
          <label class="block mb-1 font-semibold">Fecha</label>
          <input type="date" v-model="form.fecha" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Tipo -->
        <div>
          <label class="block mb-1 font-semibold">Tipo de Evento</label>
          <select v-model="form.tipo" class="w-full border rounded px-3 py-2">
            <option value="">Seleccione un tipo</option>
            <option value="peluqueria">Pelu</option>
            <option value="consulta">Consulta</option>
            <option value="otro">Otro</option>
          </select>
        </div>

       <!-- Fecha y hora de inicio -->
<div>
  <label class="block mb-1 font-semibold">Inicio (yyyy-mm-dd HH:MM)</label>
  <input type="text" v-model="form.start" placeholder="25-04-2025 09:00" class="w-full border rounded px-3 py-2" />
</div>

<!-- Fecha y hora de fin -->
<div>
  <label class="block mb-1 font-semibold">Fin (yyyy-mm-dd HH:MM)</label>
  <input type="text" v-model="form.end" placeholder="25-04-2025 10:00" class="w-full border rounded px-3 py-2" />
</div>

        <!-- Descripción -->
        <div class="md:col-span-2">
          <label class="block mb-1 font-semibold">Descripción</label>
          <textarea v-model="form.descripcion" class="w-full border rounded px-3 py-2" rows="2"></textarea>
        </div>

        <!-- Comentario -->
        <div class="md:col-span-2">
          <label class="block mb-1 font-semibold">Comentario</label>
          <textarea v-model="form.comentario" class="w-full border rounded px-3 py-2" rows="2"></textarea>
        </div>

        <!-- Precio -->
        <div>
          <label class="block mb-1 font-semibold">Precio (€)</label>
          <input type="number" step="0.01" v-model="form.precio" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Botón -->
        <div class="md:col-span-2 text-center mt-4">
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Guardar Evento
          </button>
        </div>

      </form>
    </div>
  </AppLayout>
</template>
