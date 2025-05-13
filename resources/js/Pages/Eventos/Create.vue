<script setup>
import FooterWorkers from '@/Components/FooterWorkers.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch, computed, onMounted } from 'vue';
import NavClientsDashboard from '@/Components/NavClientsDashboard.vue'


const { props } = usePage();
const userName = props?.userName || '';

const scrollToFormularioCita = () => {
  const element = document.getElementById('formulario-cita');
  if (element) {
    element.scrollIntoView({
      behavior: 'smooth',
      block: 'start'
    });
  }
};

// Form
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

// Watch  descripció y preu
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

// format fecha YYYY-MM-DD
const fechaDate = computed(() => {
  if (!fecha.value) return '';
  const [d, m, y] = fecha.value.split('-');
  return `${y}-${m}-${d}`;
});

// combinar fecha hora
const start = computed(() => {
  if (fecha.value && hora.value) {
    const [d, m, y] = fecha.value.split('-');
    return `${y}-${m}-${d} ${hora.value}`;
  }
  return '';
});

// Watch actualitzar fecha hora (start)
watch([fecha, hora], () => {
  updateStartEnd();
});

// format fecha DD-MM-YYYY
function updateFecha(e) {
  const [y, m, d] = e.target.value.split('-');
  fecha.value = `${d}-${m}-${y}`;
}

// convertir format
function convertToISODate(dmy) {
  const [d, m, y] = dmy.split('-');
  return `${y}-${m}-${d}`;
}

// Actualitzar form.start y form.end
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

//titol
onMounted(() => {
  form.title = `Reserva de cita de: ${userName}`;
});

</script>

<template>
    <AppLayout title="Nuevo Evento">
      <template #header>
        <h2 class="hidden lg:block font-semibold text-xl text-gray-800 leading-tight">
        Eventos
      </h2>
      <NavClientsDashboard />
      </template>
       <!-- Sección de Servicios -->
    <div class="max-w-7xl mx-auto px-4 py-10">
      <h2 class="text-3xl font-bold text-center text-blue-700 mb-4">
        Servicios ofrecidos por nuestras clínicas
      </h2>
      <p class="text-gray-600 text-center mb-10">
        En Vet&Care ofrecemos una amplia gama de servicios veterinarios, estéticos y preventivos para garantizar el bienestar de tus mascotas. Consulta nuestros precios y beneficios para afiliados.
      </p>
      <p class="text-gray-600 text-center mb-4">
  ¿Estás listo para reservar tu cita? Haz clic en el siguiente botón para acceder al formulario de reserva.
</p>
<div class="text-center mb-10">
  <button
    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
   @click="scrollToFormularioCita"
  >
    Reservar Cita
  </button>
</div>


      <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Pedicura</h3>
          <p class="text-gray-700 text-sm mb-4">Corte y limado de uñas para perro, incluye limpieza de almohadillas.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: 10€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Peluquería</h3>
          <p class="text-gray-700 text-sm mb-4">Corte de pelo profesional, incluye baño con productos especiales y secado.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: 30€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Lavado</h3>
          <p class="text-gray-700 text-sm mb-4">Baño con shampoo dermatológico especial para pieles sensibles. Incluye secado.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: 25€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Vacunación</h3>
          <p class="text-gray-700 text-sm mb-4">Vacunas esenciales y complementarias. Consulta con nuestros especialistas para el calendario personalizado.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 30€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Cita veterinaria</h3>
          <p class="text-gray-700 text-sm mb-4">Consulta general. Revisión completa del estado de salud, control de peso, piel, ojos, oído, exploración abdominal y más.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 30€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Castraciones</h3>
          <p class="text-gray-700 text-sm mb-4">Intervención segura con anestesia. Incluye seguimiento postoperatorio.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 90€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Esterilizaciones</h3>
          <p class="text-gray-700 text-sm mb-4">Cirugía preventiva para hembras. Incluye anestesia, hospitalización y medicación.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 120€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Eutanasia</h3>
          <p class="text-gray-700 text-sm mb-4">Procedimiento compasivo y respetuoso para garantizar una despedida tranquila.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 70€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Hospitalización</h3>
          <p class="text-gray-700 text-sm mb-4">Cuidado postoperatorio o en tratamientos intensivos. Supervisión continua y atención veterinaria.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 40€/día</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Diagnóstico</h3>
          <p class="text-gray-700 text-sm mb-4">Ecografías, radiografías, análisis clínicos, citología y ECG para un diagnóstico preciso.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio: Desde 25€</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
          <h3 class="text-lg font-bold text-blue-700 mb-2">Odontología canina</h3>
          <p class="text-gray-700 text-sm mb-4">Limpieza dental con ultrasonidos, revisión bucal, extracciones si son necesarias.</p>
          <p class="text-sm text-gray-500 font-semibold">Precio:Desde 60€</p>
</div>
</div>
</div>

      <div id="formulario-cita" class="max-w-4xl mx-auto px-6 py-10 bg-white rounded-lg shadow mt-8">
  <h1 class="text-xl text-gray-500 font-semibold mb-6">Reservar Cita</h1>

        <form @submit.prevent="form.post(route('eventos.store'))">

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Fecha -->
            <div>
              <label for="fecha" class="block text-sm font-semibold text-gray-700">Fecha</label>
              <input
                id="fecha"
                type="date"
                :value="fechaDate"
                @input="updateFecha"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required
              />
            </div>

            <!-- Tipo de cita -->
            <div>
              <label for="tipo" class="block text-sm font-semibold text-gray-700">Tipo de cita</label>
              <select
                id="tipo"
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
              <label for="hora" class="block text-sm font-semibold text-gray-700">Hora de inicio</label>
              <input
                id="hora"
                type="time"
                v-model="hora"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required
              />
            </div>

            <!-- Hidden End -->
            <input id="end" type="text" :value="form.end" hidden />

            <!-- Descripción -->
            <div class="md:col-span-2">
              <label for="descripcion" class="block text-sm font-semibold text-gray-700">Descripción</label>
              <textarea
                id="descripcion"
                v-model="form.descripcion"
                rows="2"
                readonly
                class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100"
              ></textarea>
            </div>

            <!-- Comentario -->
            <div class="md:col-span-2">
              <label for="comentario" class="block text-sm font-semibold text-gray-700">¿Quieres añadir algún comentario?</label>
              <textarea
                id="comentario"
                v-model="form.comentario"
                rows="2"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              ></textarea>
            </div>

            <!-- Fecha + hora (start)-->
            <div>
              <label for="start" class="block text-sm font-semibold text-gray-700">Reservando cita para:</label>
              <input
                id="start"
                type="text"
                :value="start"
                readonly
                class="mt-2 p-2 w-full border border-gray-300 rounded-md bg-gray-100"
              />
            </div>

            <!-- Precio -->
            <div>
              <label for="precio" class="block text-sm font-semibold text-gray-700">Precio (€)</label>
              <input
                id="precio"
                type="number"
                step="0.01"
                v-model="form.precio"
                class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                required readonly
              />
            </div>

            <!--titol hidden -->
            <input id="title" type="text" v-model="form.title" hidden />
          </div>

          <!-- Botó -->
          <div class="text-center mt-8">
            <button
              type="submit"
              class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-200"
            >
              Reservar
            </button>
            <p class="text-gray-600 text-center mt-6">
 Recordatorio: La reserva de cita no es definitiva, una vez realizada se informará al cliente a traves de watsapp o llamada sobre la confirmación de la cita</p>

          </div>
        </form>
      </div>
      <FooterWorkers />
    </AppLayout>
  </template>
