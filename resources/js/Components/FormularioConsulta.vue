<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
  animales: Array,
  users: Array,
});

// form
const form = useForm({
  animal_id: '',
  user_id: '',
  fecha: '',
  hora: '',
  lugar: '',
  peso: '',
  precio: '',
  tipo_animal: '',
  raza: '',
  motivo: '',
  anamnesis: '',
  examen_fisico: '',
  diagnostico: '',
  tratamiento: '',
  observaciones: '',
});

// Plenar info al form
watch(() => form.animal_id, (animalId) => {
  const selected = props.animales.find(animal => animal.id === parseInt(animalId));
  if (selected && selected.user) {
    form.tipo_animal = selected.tipo;
    form.raza = selected.raza;
    form.peso = selected.peso;
    form.user_id = selected.user.id;
  } else {
    form.tipo_animal = '';
    form.raza = '';
    form.peso = '';
  }
});
</script>
<template>
    <form @submit.prevent="form.post(route('alta.storeConsulta'))" class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Animal -->
      <div>
        <label for="animal_id" class="block mb-1 font-semibold">Animal</label>
        <select id="animal_id" name="animal_id" v-model="form.animal_id" class="w-full border rounded px-3 py-2">
          <option value="">Seleccione un animal</option>
          <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">
            {{ animal.nombre }}
          </option>
        </select>
      </div>

      <!-- Veterinario -->
      <div>
        <label for="user_id" class="block mb-1 font-semibold">Veterinario</label>
        <select id="user_id" name="user_id" v-model="form.user_id" class="w-full border rounded px-3 py-2">
          <option value="">Seleccione un veterinario</option>
          <option v-for="user in props.users" :key="user.id" :value="user.id">
            {{ user.name }} {{ user.apellidos }}
          </option>
        </select>
      </div>

      <!-- Fecha -->
      <div>
        <label for="fecha" class="block mb-1 font-semibold">Fecha</label>
        <input id="fecha" name="fecha" type="date" v-model="form.fecha" class="w-full border rounded px-3 py-2" />
      </div>

      <!-- Hora -->
      <div>
        <label for="hora" class="block mb-1 font-semibold">Hora</label>
        <input id="hora" name="hora" type="time" v-model="form.hora" class="w-full border rounded px-3 py-2" />
      </div>

      <!-- Lugar -->
      <div>
        <label for="lugar" class="block mb-1 font-semibold">Lugar</label>
        <input id="lugar" name="lugar" type="text" v-model="form.lugar" class="w-full border rounded px-3 py-2" />
      </div>

      <!-- Peso -->
      <div>
        <label for="peso" class="block mb-1 font-semibold">Peso (kg)</label>
        <input id="peso" name="peso" type="number" step="0.01" v-model="form.peso" class="w-full border rounded px-3 py-2" readonly />
      </div>

      <!-- Tipo de Animal -->
      <div>
        <label for="tipo_animal" class="block mb-1 font-semibold">Tipo de Animal</label>
        <input id="tipo_animal" name="tipo_animal" type="text" v-model="form.tipo_animal" class="w-full border rounded px-3 py-2 bg-gray-100" readonly />
      </div>

      <!-- Raza -->
      <div>
        <label for="raza" class="block mb-1 font-semibold">Raza</label>
        <input id="raza" name="raza" type="text" v-model="form.raza" class="w-full border rounded px-3 py-2 bg-gray-100" readonly />
      </div>

      <!-- Motivo -->
      <div class="md:col-span-2">
        <label for="motivo" class="block mb-1 font-semibold">Motivo</label>
        <textarea id="motivo" name="motivo" v-model="form.motivo" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Anamnesis -->
      <div class="md:col-span-2">
        <label for="anamnesis" class="block mb-1 font-semibold">Anamnesis</label>
        <textarea id="anamnesis" name="anamnesis" v-model="form.anamnesis" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Examen Físico -->
      <div class="md:col-span-2">
        <label for="examen_fisico" class="block mb-1 font-semibold">Examen Físico</label>
        <textarea id="examen_fisico" name="examen_fisico" v-model="form.examen_fisico" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Diagnóstico -->
      <div class="md:col-span-2">
        <label for="diagnostico" class="block mb-1 font-semibold">Diagnóstico</label>
        <textarea id="diagnostico" name="diagnostico" v-model="form.diagnostico" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Tratamiento -->
      <div class="md:col-span-2">
        <label for="tratamiento" class="block mb-1 font-semibold">Tratamiento</label>
        <textarea id="tratamiento" name="tratamiento" v-model="form.tratamiento" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Observaciones -->
      <div class="md:col-span-2">
        <label for="observaciones" class="block mb-1 font-semibold">Observaciones</label>
        <textarea id="observaciones" name="observaciones" v-model="form.observaciones" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Precio -->
      <div>
        <label for="precio" class="block mb-1 font-semibold">Precio (€)</label>
        <input id="precio" name="precio" type="number" step="0.01" v-model="form.precio" class="w-full border rounded px-3 py-2" />
      </div>

      <!-- Botón -->
      <div class="md:col-span-2 text-center mt-4">
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
          Guardar Consulta
        </button>
      </div>
    </form>
  </template>
