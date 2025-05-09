<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const props = defineProps({
  auxiliares: Array,
  animales: Array,
});

const form = useForm({
  animal_id: '',
  user_id: '',
  tipo_servicio: '',
  descripcion: '',
  duracion: '',
  precio: '',
  fecha: '',
  hora: '',
  cliente: '',
});

// Watcher actualitzar info user
watch(() => form.animal_id, (animalId) => {
  const selected = props.animales.find(animal => animal.id === parseInt(animalId));
  if (selected && selected.user) {
    form.user_id = selected.user.id;
    form.cliente = selected.user.name + ' ' + selected.user.apellidos;
  } else {
    form.user_id = '';
    form.cliente = '';
  }
});

// Watcher actualitzar descripcio, duració, preu
watch(() => form.tipo_servicio, (newTipoServicio) => {
  switch (newTipoServicio) {
    case 'pedicura':
      form.descripcion = 'Corte y limado de uñas para perro, incluye limpieza de almohadillas.';
      form.duracion = 15;
      form.precio = 10;
      break;
    case 'peluqueria':
      form.descripcion = 'Corte de pelo para perro, incluye baño y secado.';
      form.duracion = 60;
      form.precio = 30;
      break;
    case 'lavado':
      form.descripcion = 'Baño con shampoo especial para la piel sensible del animal.';
      form.duracion = 50;
      form.precio = 25;
      break;
    case 'cita_veterinario':
      form.descripcion = '';
      form.duracion = 30;
      form.precio = 30;
      break;
    default:
      form.descripcion = '';
      form.duracion = '';
      form.precio = '';
      break;
  }
});

const autoResize = (event) => {
  const textarea = event.target;
  textarea.style.height = "auto"; // Reset
  textarea.style.height = textarea.scrollHeight + "px"; // Ajuste dinámico
};

</script>

<template>
    <form @submit.prevent="form.post(route('servicios.store'))" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Animal -->
        <div class="relative z-0 w-full group">
          <select v-model="form.animal_id" id="animal_id" name="animal_id" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600">
            <option disabled value="">Seleccione un animal</option>
            <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">{{ animal.nombre }}</option>
          </select>
          <label for="animal_id" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Animal</label>
        </div>

        <!-- Cliente -->
        <div class="relative z-0 w-full group">
          <input v-model="form.cliente" type="text" id="cliente" name="cliente" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" readonly />
          <label for="cliente" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Cliente</label>
        </div>

        <!-- Auxiliar -->
        <div class="relative z-0 w-full group">
          <select v-model="form.user_id" id="user_id" name="user_id" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600">
            <option disabled value="">Seleccione un auxiliar</option>
            <option v-for="user in props.auxiliares" :key="user.id" :value="user.id">{{ user.name }} {{ user.apellidos }}</option>
          </select>
          <label for="user_id" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Auxiliar</label>
        </div>

        <!-- Tipo de Servicio -->
        <div class="relative z-0 w-full group">
          <select v-model="form.tipo_servicio" id="tipo_servicio" name="tipo_servicio" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600">
            <option disabled value="">Seleccione un tipo de servicio</option>
            <option value="peluqueria">Peluquería</option>
            <option value="pedicura">Pedicura</option>
            <option value="lavado">Lavado</option>
            <option value="cita_veterinario">Cita Veterinario</option>
          </select>
          <label for="tipo_servicio" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Tipo de Servicio</label>
        </div>

        <!-- Duración -->
        <div class="relative z-0 w-full group">
          <input v-model="form.duracion" type="number" id="duracion" name="duracion" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" />
          <label for="duracion" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Duración (minutos)</label>
        </div>

        <!-- Precio -->
        <div class="relative z-0 w-full group">
          <input v-model="form.precio" type="number" step="0.01" id="precio" name="precio" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" />
          <label for="precio" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Precio (€)</label>
        </div>

        <!-- Fecha -->
        <div class="relative z-0 w-full group">
          <input v-model="form.fecha" type="date" id="fecha" name="fecha" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" />
          <label for="fecha" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Fecha</label>
        </div>

        <!-- Hora -->
        <div class="relative z-0 w-full group">
          <input v-model="form.hora" type="time" id="hora" name="hora" class="peer block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600" />
          <label for="hora" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Hora</label>
        </div>
      </div>

      <!-- Descripción -->
      <div class="relative z-0 w-full group">
        <textarea
    v-model="form.descripcion"
    id="descripcion"
    name="descripcion"
    rows="1"
    @input="autoResize($event)"
    class="block overflow-hidden resize-none py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
    placeholder=" "
  ></textarea>
    <label for="descripcion" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Descripción</label>
      </div>

      <!-- Botón -->
      <div class="text-center pt-4">
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-300">
          Guardar Servicio
        </button>
      </div>
    </form>
  </template>
