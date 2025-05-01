<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';


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

// Watcher para actualizar el campo user_id y cliente según el animal seleccionado
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

// Watcher para actualizar la descripción, duración y precio según el tipo de servicio seleccionado
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
  <AppLayout title="Nuevo Servicio">
    <template #header>
      <NavBar />
    </template>

    <div class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-lg shadow mt-8">
      <h2 class="text-2xl font-bold text-center mb-8">Registrar Nuevo Servicio</h2>

      <form @submit.prevent="form.post(route('servicios.store'))" class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Animal -->
        <div>
          <label class="block mb-1 font-semibold">Animal</label>
          <select v-model="form.animal_id" class="w-full border rounded px-3 py-2">
            <option value="">Seleccione un animal</option>
            <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">
              {{ animal.nombre }}
            </option>
          </select>
        </div>

        <!-- Cliente (nombre y apellidos) -->
        <div>
          <label class="block mb-1 font-semibold">Cliente</label>
          <input type="text" v-model="form.cliente" class="w-full border rounded px-3 py-2" readonly />
        </div>

        <!-- Auxiliar -->
        <div>
          <label class="block mb-1 font-semibold">Auxiliar</label>
          <select v-model="form.user_id" class="w-full border rounded px-3 py-2">
            <option value="">Seleccione un auxiliar</option>
            <option v-for="user in props.auxiliares" :key="user.id" :value="user.id">
              {{ user.name }} {{ user.apellidos }}
            </option>
          </select>
        </div>

        <!-- Tipo de Servicio -->
        <div>
          <label class="block mb-1 font-semibold">Tipo de Servicio</label>
          <select v-model="form.tipo_servicio" class="w-full border rounded px-3 py-2">
            <option value="">Seleccione un tipo de servicio</option>
            <option value="peluqueria">Peluquería</option>
            <option value="pedicura">Pedicura</option>
            <option value="lavado">Lavado</option>
            <option value="cita_veterinario">Cita Veterinario</option>
          </select>
        </div>

        <!-- Descripción -->
        <div class="md:col-span-2">
          <label class="block mb-1 font-semibold">Descripción</label>
          <textarea v-model="form.descripcion" class="w-full border rounded px-3 py-2" rows="2"></textarea>
        </div>

        <!-- Duración -->
        <div>
          <label class="block mb-1 font-semibold">Duración (minutos)</label>
          <input type="number" v-model="form.duracion" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Precio -->
        <div>
          <label class="block mb-1 font-semibold">Precio (€)</label>
          <input type="number" step="0.01" v-model="form.precio" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Fecha -->
        <div>
          <label class="block mb-1 font-semibold">Fecha</label>
          <input type="date" v-model="form.fecha" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Hora -->
        <div>
          <label class="block mb-1 font-semibold">Hora</label>
          <input type="time" v-model="form.hora" class="w-full border rounded px-3 py-2" />
        </div>

        <!-- Botón -->
        <div class="md:col-span-2 text-center mt-4">
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
            Guardar Servicio
          </button>
        </div>

      </form>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
