<script setup>
import FooterWorkers from '@/Components/FooterWorkers.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch, computed, onMounted } from 'vue';

const { props } = usePage();
const userName = props?.userName || '';

// Formulario
const form = useForm({
  title: '',
  fecha: '', // dd-mm-yyyy
  start: '', // yyyy-mm-dd HH:mm
  end: '',   // yyyy-mm-dd HH:mm
  tipo: '',
  descripcion: '',
  comentario: '',
  precio: '',
});

const fecha = ref('');
const hora = ref('08:00');

// Watch para establecer automáticamente descripción y precio
watch(() => form.tipo, (newTipoEvento) => {
  switch (newTipoEvento) {
    case 'pedicura':
      form.descripcion = 'Corte y limado de uñas para perro, incluye limpieza de almohadillas.';
      form.precio = 10;
      break;
    case 'peluqueria':
      form.descripcion = 'Corte de pelo para perro, incluye baño y secado.';
      form.precio = 30;
      break;
    case 'lavado':
      form.descripcion = 'Baño con shampoo especial para la piel sensible del animal.';
      form.precio = 25;
      break;
    case 'cita veterinaria':
      form.descripcion = 'Consulta veterinaria general, los precios pueden variar según los requerimientos de la consulta. Consulta mínima visita:30 euros';
      form.precio = 30;
      break;
    case 'vacunacion':
      form.descripcion = 'El precio varía dependiendo del tipo de vacunación.';
      form.precio = 30;
      break;
    default:
      form.descripcion = '';
      form.precio = '';
  }
  updateStartEnd();
});

// Computado: para mostrar la fecha en formato YYYY-MM-DD en el input
const fechaDate = computed(() => {
  if (!fecha.value) return '';
  const [d, m, y] = fecha.value.split('-');
  return `${y}-${m}-${d}`;
});

// Computado: combinar fecha y hora en formato completo
const start = computed(() => {
  if (fecha.value && hora.value) {
    const [d, m, y] = fecha.value.split('-');
    return `${y}-${m}-${d} ${hora.value}`;
  }
  return '';
});

// Watch para actualizar automáticamente start y end al cambiar fecha u hora
watch([fecha, hora], () => {
  updateStartEnd();
});

// Actualizar fecha desde el input
function updateFecha(e) {
  const [y, m, d] = e.target.value.split('-');
  fecha.value = `${d}-${m}-${y}`;
}

// Función para convertir formato
function convertToISODate(dmy) {
  const [d, m, y] = dmy.split('-');
  return `${y}-${m}-${d}`;
}

// Actualiza form.start y form.end
function updateStartEnd() {
  if (fecha.value && hora.value) {
    const isoDate = convertToISODate(fecha.value);
    form.fecha = fecha.value;
    form.start = `${isoDate} ${hora.value}`;
    const [h, min] = hora.value.split(':');
    let hEnd = parseInt(h) + 1;
    if (hEnd === 24) hEnd = 0;
    form.end = `${isoDate} ${hEnd.toString().padStart(2, '0')}:${min}`;
  }
}

onMounted(() => {
  form.title = `Reserva de cita de: ${userName}`;
});

</script>


<template>
    <AppLayout title="Nuevo Evento">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Reservar cita
        </h2>
      </template>

      <div class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-lg shadow mt-8">
        <form @submit.prevent="form.post(route('eventos.store'))">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Fecha -->
            <div>
              <label class="block text-sm font-semibold text-gray-700">Fecha</label>
              <input
                type="date"
                :value="fechaDate"
                @input="updateFecha"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required
              />
            </div>

            <!-- Tipo de cita -->
            <div>
              <label class="block text-sm font-semibold text-gray-700">Tipo de cita</label>
              <select
                v-model="form.tipo"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required
              >
                <option value="">Seleccione un tipo</option>
                <option value="peluqueria">Servicio Peluquería</option>
                <option value="pedicura">Servicio Pedicura</option>
                <option value="lavado">Servicio Lavado</option>
                <option value="cita veterinaria">Cita Veterinaria</option>
                <option value="vacunacion">Vacunación</option>
              </select>
            </div>

            <!-- Hora -->
            <div>
              <label class="block text-sm font-semibold text-gray-700">Hora de inicio</label>
              <input
                type="time"
                v-model="hora"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required
              />
            </div>

            <!-- Campo oculto End -->
            <input type="text" :value="form.end" hidden />

            <!-- Descripción -->
            <div class="md:col-span-2">
              <label class="block text-sm font-semibold text-gray-700">Descripción</label>
              <textarea
                v-model="form.descripcion"
                rows="2"
                readonly
                class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100"
              ></textarea>
            </div>

            <!-- Comentario -->
            <div class="md:col-span-2">
              <label class="block text-sm font-semibold text-gray-700">¿Quieres añadir algún comentario?</label>
              <textarea
                v-model="form.comentario"
                rows="2"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              ></textarea>
            </div>

            <!-- Fecha + hora combinadas -->
            <div>
              <label class="block text-sm font-semibold text-gray-700">Reservando cita para:</label>
              <input
                type="text"
                :value="start"
                readonly
                class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100"
              />
            </div>

            <!-- Precio -->
            <div>
              <label class="block text-sm font-semibold text-gray-700">Precio (€)</label>
              <input
                type="number"
                step="0.01"
                v-model="form.precio"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required
              />
            </div>

            <!-- Campo oculto título -->
            <input type="text" v-model="form.title" hidden />
          </div>

          <!-- Botón -->
          <div class="text-center mt-8">
            <button
              type="submit"
              class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200"
            >
              Guardar Evento
            </button>
          </div>
        </form>
      </div>
      <FooterWorkers />
    </AppLayout>
  </template>
