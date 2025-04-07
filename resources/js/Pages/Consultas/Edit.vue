<script setup>
import NavBar from '@/Components/NavBar.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  consulta: Object,  // Recibe el objeto consulta para editar
  animales: Array,
  veterinarios: Array,
});

const form = useForm({
  animal_id: props.consulta.animal_id || '',
  veterinario_id: props.consulta.veterinario_id || '',
  fecha: props.consulta.fecha || '',
  lugar: props.consulta.lugar || '',
  peso: props.consulta.peso || '',
  tipo_animal: props.consulta.tipo_animal || '',
  raza: props.consulta.raza || '',
  motivo: props.consulta.motivo || '',
  anamnesis: props.consulta.anamnesis || '',
  examen_fisico: props.consulta.examen_fisico || '',
  diagnostico: props.consulta.diagnostico || '',
  tratamiento: props.consulta.tratamiento || '',
  observaciones: props.consulta.observaciones || '',
});

const submit = () => {
  form.put(route('consultas.update', props.consulta.id), {
    onSuccess: () => {
      alert("¡Consulta actualizada correctamente!");
    },
    onError: (errors) => {
      console.log(errors);
    }
  });
};
</script>

<template>
  <AppLayout title="Editar Consulta">
    <template #header>
      <NavBar />
    </template>

    <div class="container mx-auto my-12">
      <div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Editar Consulta</h2>

        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="animal_id" class="block text-gray-700 font-medium">Animal</label>
            <select v-model="form.animal_id" id="animal_id" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required>
              <option value="">Seleccione un animal</option>
              <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">
                {{ animal.nombre }}
              </option>
            </select>
            <div v-if="form.errors.animal_id" class="text-red-500 text-sm mt-1">{{ form.errors.animal_id }}</div>
          </div>

          <div class="mb-4">
            <label for="veterinario_id" class="block text-gray-700 font-medium">Veterinario</label>
            <select v-model="form.veterinario_id" id="veterinario_id" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required>
              <option value="">Seleccione un veterinario</option>
              <option v-for="veterinario in props.veterinarios" :key="veterinario.id" :value="veterinario.id">
                {{ veterinario.nombre }}
              </option>
            </select>
            <div v-if="form.errors.veterinario_id" class="text-red-500 text-sm mt-1">{{ form.errors.veterinario_id }}</div>
          </div>

          <div class="mb-4">
            <label for="fecha" class="block text-gray-700 font-medium">Fecha</label>
            <input v-model="form.fecha" type="date" id="fecha" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
            <div v-if="form.errors.fecha" class="text-red-500 text-sm mt-1">{{ form.errors.fecha }}</div>
          </div>

          <div class="mb-4">
            <label for="lugar" class="block text-gray-700 font-medium">Lugar</label>
            <input v-model="form.lugar" type="text" id="lugar" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
            <div v-if="form.errors.lugar" class="text-red-500 text-sm mt-1">{{ form.errors.lugar }}</div>
          </div>

          <div class="mb-4">
            <label for="peso" class="block text-gray-700 font-medium">Peso</label>
            <input v-model="form.peso" type="number" id="peso" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
            <div v-if="form.errors.peso" class="text-red-500 text-sm mt-1">{{ form.errors.peso }}</div>
          </div>

          <div class="mb-4">
            <label for="motivo" class="block text-gray-700 font-medium">Motivo</label>
            <input v-model="form.motivo" type="text" id="motivo" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
            <div v-if="form.errors.motivo" class="text-red-500 text-sm mt-1">{{ form.errors.motivo }}</div>
          </div>

          <div class="mb-4">
            <label for="anamnesis" class="block text-gray-700 font-medium">Anamnesis</label>
            <textarea v-model="form.anamnesis" id="anamnesis" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
            <div v-if="form.errors.anamnesis" class="text-red-500 text-sm mt-1">{{ form.errors.anamnesis }}</div>
          </div>

          <div class="mb-4">
            <label for="examen_fisico" class="block text-gray-700 font-medium">Examen Físico</label>
            <textarea v-model="form.examen_fisico" id="examen_fisico" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
            <div v-if="form.errors.examen_fisico" class="text-red-500 text-sm mt-1">{{ form.errors.examen_fisico }}</div>
          </div>

          <div class="mb-4">
            <label for="diagnostico" class="block text-gray-700 font-medium">Diagnóstico</label>
            <textarea v-model="form.diagnostico" id="diagnostico" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
            <div v-if="form.errors.diagnostico" class="text-red-500 text-sm mt-1">{{ form.errors.diagnostico }}</div>
          </div>

          <div class="mb-4">
            <label for="tratamiento" class="block text-gray-700 font-medium">Tratamiento</label>
            <textarea v-model="form.tratamiento" id="tratamiento" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
            <div v-if="form.errors.tratamiento" class="text-red-500 text-sm mt-1">{{ form.errors.tratamiento }}</div>
          </div>

          <div class="mb-4">
            <label for="observaciones" class="block text-gray-700 font-medium">Observaciones</label>
            <textarea v-model="form.observaciones" id="observaciones" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
            <div v-if="form.errors.observaciones" class="text-red-500 text-sm mt-1">{{ form.errors.observaciones }}</div>
          </div>

          <div class="flex justify-center gap-4">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Actualizar Consulta</button>
            <a :href="route('consultas.index')" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Volver</a>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
