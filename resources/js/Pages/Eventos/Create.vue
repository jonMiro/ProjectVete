<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

// Formulario
const form = useForm({
  title: '',
  fecha: '', // dd-mm-yyy
  start: '', // HH:mm
  end: '',   // HH:mm
  tipo: '',
  descripcion: '',
  comentario: '',
  precio: '',
});

//Actualizar la descripción, duración y precio según el tipo de servicio
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
      form.descripcion = 'El precio varia dependiendo del tipo de vacunación.';
      form.precio = 30;
      break;
    default:
      form.descripcion = '';
      form.duracion = '';
      form.precio = '';
      break;
  }
});

//Convertir la fecha de dd-mm-yyyy a yyyy-mm-dd
function convertToISODate(date) {
  const [day, month, year] = date.split('-');
  return `${year}-${month}-${day}`;
}

// Actualizar los valores de start y end
function updateStartEnd() {
  if (form.fecha) {
    const formattedDate = convertToISODate(form.fecha);
    // Establecer las horas predeterminadas sin exponer formattedDate
    form.start = `09:00`;
    form.end = `10:00`;
  }
}

// Método para actualizar la hora de inicio
function updateStartTime() {
  if (form.fecha && form.start) {
    const formattedDate = convertToISODate(form.fecha); // Convertir la fecha a yyyy-mm-dd
    const [hours, minutes] = form.start.split(':'); // Extraer horas y minutos
    form.start = `${formattedDate} ${hours}:${minutes}`; // Concatenar fecha + hora
    updateEndTime(); // Actualizar la hora de fin automáticamente
  }
}

// Método para actualizar la hora de fin (sumando una hora la hora de inicio)
function updateEndTime() {
  if (form.start) {
    const [startDate, startTime] = form.start.split(' '); // Separar fecha y hora
    const [startHours, startMinutes] = startTime.split(':'); // Extraer hora y minutos de start
    let endHours = parseInt(startHours) + 1; // Sumar 1 hora al inicio
    if (endHours === 24) endHours = 0; // Asegurarse de que no pase de las 23 horas
    form.end = `${startDate} ${endHours.toString().padStart(2, '0')}:${startMinutes}`; // Establecer la hora de fin con fecha
  }
}
</script>

<template>
  <AppLayout title="Nuevo Evento">
    <template #header>
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
          <input type="text" v-model="form.fecha" placeholder="dd-mm-yyyy" class="w-full border rounded px-3 py-2" @change="updateStartEnd" />
        </div>

        <!-- Tipo -->
        <div>
          <label class="block mb-1 font-semibold">Tipo de Evento</label>
          <select v-model="form.tipo" class="w-full border rounded px-3 py-2">
            <option value="">Seleccione un tipo</option>
            <option value="peluqueria">Servicio Peluqueria</option>
            <option value="pedicura">Servicio Pedicura</option>
            <option value="lavado">Servicio Lavado</option>
            <option value="cita veterinaria">Cita Veterinaria</option>
            <option value="vacunacion">Vacunación</option>
          </select>
        </div>

        <!-- Hora de inicio (editable) -->
        <div>
          <label class="block mb-1 font-semibold">Inicio (Hora)</label>
          <input type="text" v-model="form.start" class="w-full border rounded px-3 py-2" @change="updateStartTime" />
        </div>

        <!-- Hora de fin (editable) -->
        <div>
          <label class="block mb-1 font-semibold">Fin (Hora)</label>
          <input type="text" :value="form.end" class="w-full border rounded px-3 py-2" />
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
