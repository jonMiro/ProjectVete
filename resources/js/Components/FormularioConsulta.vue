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

// Redimensionar el textarea (vaja aumentant tamany)
const autoResize = (event) => {
  const textarea = event.target;
  textarea.style.height = "auto"; // Reset
  textarea.style.height = textarea.scrollHeight + "px"; // Ajust dinámic
};

// Plenar info al form
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
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
    <form @submit.prevent="form.post(route('alta.storeConsulta'))" class="grid grid-cols-1 md:grid-cols-2 gap-6">

      <!-- Animal -->
      <div class="relative">
        <select
          id="animal_id"
          name="animal_id"
          v-model="form.animal_id"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
        >
          <option value="" disabled selected>Seleccione un animal</option>
          <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">
            {{ animal.nombre }}
          </option>
        </select>
        <label for="animal_id" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all peer-focus:text-blue-600">
          Animal
        </label>
      </div>

      <!-- Veterinario -->
      <div class="relative">
    <select
      id="user_id"
      name="user_id"
      v-model="form.user_id"
      class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
    >
      <option value="" disabled selected>Seleccione un veterinario</option>
      <!-- Filtrem per tipo 'veterinario' -->
      <option v-for="user in props.users.filter(user => user.tipo === 'veterinario')" :key="user.id" :value="user.id">
        {{ user.name }} {{ user.apellidos }}
      </option>
    </select>
    <label for="user_id" class="absolute left-0 top-1 text-gray-500 ml-2 text-sm transition-all peer-focus:text-blue-600">
      Veterinario
    </label>
  </div>



      <!-- Fecha -->
      <div class="relative">
        <input
          type="date"
          id="fecha"
          name="fecha"
          v-model="form.fecha"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
        />
        <label for="fecha" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all peer-focus:text-blue-600">
          Fecha
        </label>
      </div>

      <!-- Hora -->
      <div class="relative">
        <input
          type="time"
          id="hora"
          name="hora"
          v-model="form.hora"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
        />
        <label for="hora" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all peer-focus:text-blue-600">
          Hora
        </label>
      </div>

      <!-- Lugar -->
      <div class="relative">
        <input
          type="text"
          id="lugar"
          name="lugar"
          v-model="form.lugar"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
        />
        <label for="lugar" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all peer-focus:text-blue-600">
          Lugar
        </label>
      </div>

      <!-- Peso -->
      <div class="relative">
        <input
          type="number"
          step="0.01"
          id="peso"
          name="peso"
          v-model="form.peso"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
        />
        <label for="peso" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all peer-focus:text-blue-600">
          Peso (kg)
        </label>
      </div>

      <!-- Tipo de Animal -->
      <div class="relative">
        <input
          type="text"
          id="tipo_animal"
          name="tipo_animal"
          v-model="form.tipo_animal"
          class="peer w-full bg-gray-100 border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
          readonly
        />
        <label for="tipo_animal" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all">
          Tipo de Animal
        </label>
      </div>

      <!-- Raza -->
      <div class="relative">
        <input
          type="text"
          id="raza"
          name="raza"
          v-model="form.raza"
          class="peer w-full bg-gray-100 border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6"
          readonly
        />
        <label for="raza" class="absolute left-0 top-1 ml-2 text-gray-500 text-sm transition-all">
          Raza
        </label>
      </div>

      <!-- Motivo -->
      <div class="md:col-span-2 relative">
        <textarea
          id="motivo"
          name="motivo"
          rows="2"
          v-model="form.motivo"
          @input="autoResize"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6 pb-2 resize-none transition-all"
        ></textarea>
        <label for="motivo" class="absolute left-0 top-0 ml-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-600">
          Motivo
        </label>
      </div>

      <!-- Anamnesis -->
      <div class="md:col-span-2 relative">
        <textarea
          id="anamnesis"
          name="anamnesis"
          rows="2"
          v-model="form.anamnesis"
          @input="autoResize"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6 pb-2 resize-none transition-all"
        ></textarea>
        <label for="anamnesis" class="absolute left-0 top-0 ml-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-600">
          Anamnesis
        </label>
      </div>

      <!-- Examen Físico -->
      <div class="md:col-span-2 relative">
        <textarea
          id="examen_fisico"
          name="examen_fisico"
          rows="2"
          v-model="form.examen_fisico"
          @input="autoResize"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6 pb-2 resize-none transition-all"
        ></textarea>
        <label for="examen_fisico" class="absolute left-0 top-0 ml-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-600">
          Examen Físico
        </label>
      </div>

      <!-- Diagnóstico -->
      <div class="md:col-span-2 relative">
        <textarea
          id="diagnostico"
          name="diagnostico"
          rows="2"
          v-model="form.diagnostico"
          @input="autoResize"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6 pb-2 resize-none transition-all"
        ></textarea>
        <label for="diagnostico" class="absolute left-0 top-0 ml-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-600">
          Diagnóstico
        </label>
      </div>

      <!-- Tratamiento -->
      <div class="md:col-span-2 relative">
        <textarea
          id="tratamiento"
          name="tratamiento"
          rows="2"
          v-model="form.tratamiento"
          @input="autoResize"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6 pb-2 resize-none transition-all"
        ></textarea>
        <label for="tratamiento" class="absolute left-0 top-0 ml-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-600">
          Tratamiento
        </label>
      </div>

      <!-- Observaciones -->
      <div class="md:col-span-2 relative">
        <textarea
          id="observaciones"
          name="observaciones"
          rows="2"
          v-model="form.observaciones"
          @input="autoResize"
          class="peer w-full bg-transparent border-b-2 border-gray-300 focus:border-blue-600 outline-none pt-6 pb-2 resize-none transition-all"
        ></textarea>
        <label for="observaciones" class="absolute left-0 top-0 ml-2 text-gray-500 text-sm transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-base peer-focus:text-xs peer-focus:top-0 peer-focus:text-blue-600">
          Observaciones
        </label>
      </div>

       <!-- Precio -->
      <div>
        <label for="precio" class="block mb-1 font-semibold text-gray-500">Precio (€)</label>
        <input id="precio" name="precio" type="number" step="0.01" v-model="form.precio" class="w-full border rounded px-3 py-2" />
      </div>


      <!-- Botón de envío -->
      <div class="md:col-span-2 flex justify-end">
        <button
          type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50"
        >
          Guardar
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped>
  textarea {
    min-height: 40px;
    resize: none;
  }
</style>
