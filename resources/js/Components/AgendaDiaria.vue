<template>
    <div class="space-y-4">
      <h2 class="text-xl font-bold mb-2 flex items-center justify-between">
        <span>Agenda del día</span>
        <span class="text-base font-normal text-gray-600">{{ fechaActual }} | {{ horaActual }}</span>
      </h2>

      <!-- Mostrar horas y eventos de la agenda -->
      <div v-for="hora in horasPaginadas" :key="hora" class="flex border p-2 rounded shadow-sm items-center justify-between bg-white">
        <span class="font-mono text-gray-700 w-20">{{ hora }}</span>
        <div class="flex-1">
          <div v-if="agendaPorHora[hora]?.length">
            <div v-for="evento in agendaPorHora[hora]" :key="evento.id" class="text-sm text-gray-800 px-2 py-1 rounded mb-1"
              :class="evento.tipo === 'consulta' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'"
              @click="verEvento(evento)">
              {{ evento.title }}
            </div>
          </div>
          <div v-else class="text-gray-400 text-sm">Libre</div>
        </div>
      </div>

      <!-- Modal de evento seleccionado -->
      <div v-if="eventoSeleccionado" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-4 rounded-lg w-1/3">
          <h3 class="text-xl font-semibold">{{ eventoSeleccionado.title }}</h3>
          <p><strong>Tipo:</strong> {{ eventoSeleccionado.tipo }}</p>
          <p><strong>Precio:</strong> {{ eventoSeleccionado.precio || 'Por determinar' }}</p>
          <p><strong>Descripción:</strong> {{ eventoSeleccionado.descripcion }}</p>
          <button @click="eventoSeleccionado = null" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">Cerrar</button>
        </div>
      </div>

      <!-- Paginación -->
      <div class="flex justify-center gap-4 mt-4">
        <button
          @click="paginaActual--"
          :disabled="paginaActual === 1"
          class="px-4 py-1 border rounded bg-gray-100 hover:bg-gray-200 disabled:opacity-50"
        >
          Anterior
        </button>
        <button
          @click="paginaActual++"
          :disabled="paginaActual === totalPaginas"
          class="px-4 py-1 border rounded bg-gray-100 hover:bg-gray-200 disabled:opacity-50"
        >
          Siguiente
        </button>
      </div>
    </div>
  </template>

  <script setup>
  import { ref, computed, onMounted } from 'vue'

  const horasManana = ['09:00', '10:00', '11:00', '12:00', '13:00']
  const horasTarde = ['16:00', '17:00', '18:00', '19:00']
  const horas = [...horasManana, ...horasTarde]

  const agendaPorHora = ref({})
  const eventoSeleccionado = ref(null) // Nuevo estado para el evento seleccionado

  const fetchEvents = async () => {
    const today = new Date().toISOString().slice(0, 10) // Fecha actual en formato YYYY-MM-DD

    try {
      const response = await fetch(`/api/events?date=${today}`)
      const data = await response.json()

      const agenda = {}
      for (const hora of horas) {
        agenda[hora] = []
      }

      data.forEach(evento => {
        const hora = evento.start.slice(11, 16)
        if (agenda[hora]) {
          agenda[hora].push(evento)
        }
      })

      agendaPorHora.value = agenda
    } catch (error) {
      console.error('Error fetching events:', error)
    }
  }

  onMounted(fetchEvents)

  const paginaActual = ref(1)
  const porPagina = 5

  const totalPaginas = computed(() => Math.ceil(horas.length / porPagina))

  const horasPaginadas = computed(() => {
    const start = (paginaActual.value - 1) * porPagina
    return horas.slice(start, start + porPagina)
  })

  // Función para ver los detalles del evento
  function verEvento(evento) {
    eventoSeleccionado.value = evento
  }

  // Hora y fecha actual
  const horaActual = ref('')
  const fechaActual = ref('')

  const actualizarTiempo = () => {
    const ahora = new Date()
    const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }
    fechaActual.value = ahora.toLocaleDateString('es-ES', opcionesFecha)
    horaActual.value = ahora.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' })
  }

  onMounted(() => {
    fetchEvents()
    actualizarTiempo()
    setInterval(actualizarTiempo, 1000)
  })
  </script>

  <style scoped>
  .calendar-container {
    width: 100%;
    height: 100%;
    max-width: 800px;
    margin: 0 auto;
  }
  </style>
