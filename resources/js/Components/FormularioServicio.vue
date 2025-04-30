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
</script>

<template>
    <form @submit.prevent="form.post(route('servicios.store'))" class="grid grid-cols-1 md:grid-cols-2 gap-6">

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

      <!-- Cliente (nombre y apellidos) -->
      <div>
        <label for="cliente" class="block mb-1 font-semibold">Cliente</label>
        <input id="cliente" name="cliente" type="text" v-model="form.cliente" class="w-full border rounded px-3 py-2" readonly />
      </div>

      <!-- Auxiliar -->
      <div>
        <label for="user_id" class="block mb-1 font-semibold">Auxiliar</label>
        <select id="user_id" name="user_id" v-model="form.user_id" class="w-full border rounded px-3 py-2">
          <option value="">Seleccione un auxiliar</option>
          <option v-for="user in props.auxiliares" :key="user.id" :value="user.id">
            {{ user.name }} {{ user.apellidos }}
          </option>
        </select>
      </div>

      <!-- Tipo de Servicio -->
      <div>
        <label for="tipo_servicio" class="block mb-1 font-semibold">Tipo de Servicio</label>
        <select id="tipo_servicio" name="tipo_servicio" v-model="form.tipo_servicio" class="w-full border rounded px-3 py-2">
          <option value="">Seleccione un tipo de servicio</option>
          <option value="peluqueria">Peluquería</option>
          <option value="pedicura">Pedicura</option>
          <option value="lavado">Lavado</option>
          <option value="cita_veterinario">Cita Veterinario</option>
        </select>
      </div>

      <!-- Descripción -->
      <div class="md:col-span-2">
        <label for="descripcion" class="block mb-1 font-semibold">Descripción</label>
        <textarea id="descripcion" name="descripcion" v-model="form.descripcion" class="w-full border rounded px-3 py-2" rows="2"></textarea>
      </div>

      <!-- Duración -->
      <div>
        <label for="duracion" class="block mb-1 font-semibold">Duración (minutos)</label>
        <input id="duracion" name="duracion" type="number" v-model="form.duracion" class="w-full border rounded px-3 py-2" />
      </div>

      <!-- Precio -->
      <div>
        <label for="precio" class="block mb-1 font-semibold">Precio (€)</label>
        <input id="precio" name="precio" type="number" step="0.01" v-model="form.precio" class="w-full border rounded px-3 py-2" />
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

      <!-- Botón -->
      <div class="md:col-span-2 text-center mt-4">
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
          Guardar Servicio
        </button>
      </div>

    </form>
  </template>
