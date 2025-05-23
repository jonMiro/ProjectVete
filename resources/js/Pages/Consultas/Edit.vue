<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const props = defineProps({
  consulta: Object,
  animales: Array,
  users: Array,
});

const form = useForm({
  id: props.consulta.id,
  animal_id: props.consulta.animal_id,
  user_id: props.consulta.user_id,
  fecha: props.consulta.fecha,
  hora: props.consulta.hora,
  lugar: props.consulta.lugar,
  peso: props.consulta.peso,
  precio: props.consulta.precio,
  tipo_animal: props.consulta.tipo_animal,
  raza: props.consulta.raza,
  motivo: props.consulta.motivo,
  anamnesis: props.consulta.anamnesis,
  examen_fisico: props.consulta.examen_fisico,
  diagnostico: props.consulta.diagnostico,
  tratamiento: props.consulta.tratamiento,
  observaciones: props.consulta.observaciones,
});

watch(() => form.animal_id, (animalId) => {
  const selected = props.animales.find(animal => animal.id === parseInt(animalId));
  if (selected && selected.user) {
    form.tipo_animal = selected.tipo;
    form.raza = selected.raza;
    form.user_id = selected.user.id;
  } else {
    form.tipo_animal = '';
    form.raza = '';
  }
});
</script>

<template>
  <AppLayout title="Editar Consulta">
    <template #header>
      <NavBar />
    </template>

    <div class="max-w-4xl mx-auto px-6 py-10 mt-8 bg-white rounded-lg shadow">
      <h2 class="text-2xl font-semibold text-center mb-8">Editar Consulta</h2>

      <form @submit.prevent="form.put(route('consultas.update', { consulta: form.id }))" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Animal -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Animal</label>
          <select v-model="form.animal_id" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800">
            <option value="">Seleccione un animal</option>
            <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">
              {{ animal.nombre }}
            </option>
          </select>
        </div>

        <!-- Veterinario -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Veterinario</label>
          <select v-model="form.user_id" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800">
            <option value="">Seleccione un veterinario</option>
            <option v-for="user in props.users" :key="user.id" :value="user.id">
              {{ user.name }} {{ user.apellidos }}
            </option>
          </select>
        </div>

        <!-- Fecha -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Fecha</label>
          <input type="date" v-model="form.fecha" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
        </div>

        <!-- Hora (Solo lectura, sin v-model) -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Hora</label>
          <div class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800">
            {{ form.hora }}
          </div>
        </div>

        <!-- Lugar -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Lugar</label>
          <input type="text" v-model="form.lugar" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
        </div>

        <!-- Peso -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Peso (kg)</label>
          <input type="number" step="0.01" v-model="form.peso" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
        </div>

        <!-- Tipo de Animal (auto) -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Tipo de Animal</label>
          <input type="text" v-model="form.tipo_animal" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" readonly />
        </div>

        <!-- Raza (auto) -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Raza</label>
          <input type="text" v-model="form.raza" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" readonly />
        </div>

        <!-- Motivo -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Motivo</label>
          <textarea v-model="form.motivo" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" rows="2"></textarea>
        </div>

        <!-- Anamnesis -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Anamnesis</label>
          <textarea v-model="form.anamnesis" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" rows="2"></textarea>
        </div>

        <!-- Examen Físico -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Examen Físico</label>
          <textarea v-model="form.examen_fisico" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" rows="2"></textarea>
        </div>

        <!-- Diagnóstico -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Diagnóstico</label>
          <textarea v-model="form.diagnostico" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" rows="2"></textarea>
        </div>

        <!-- Tratamiento -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Tratamiento</label>
          <textarea v-model="form.tratamiento" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" rows="2"></textarea>
        </div>

        <!-- Observaciones -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Observaciones</label>
          <textarea v-model="form.observaciones" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" rows="2"></textarea>
        </div>

        <!-- Precio -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Precio (€)</label>
          <input type="number" step="0.01" v-model="form.precio" class="w-full peer border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
        </div>

        <!-- Botón -->
        <div class="md:col-span-2 text-center mt-4">
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Actualizar Consulta
          </button>
        </div>

      </form>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
