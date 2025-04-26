<template>
    <div class="space-y-4">
        <h2 class="text-xl font-bold mb-2 flex items-center justify-between">
  <span>Agenda del día</span>
  <span class="text-base font-normal text-gray-600">{{ fechaActual }} | {{ horaActual }}</span>
</h2>


      <div v-for="hora in horasPaginadas" :key="hora" class="flex border p-2 rounded shadow-sm items-center justify-between bg-white">
        <span class="font-mono text-gray-700 w-20">{{ hora }}</span>
        <div class="flex-1">
          <div v-if="agendaPorHora[hora]?.length">
            <div v-for="evento in agendaPorHora[hora]" :key="evento.id" class="text-sm text-gray-800 px-2 py-1 rounded mb-1"
              :class="evento.tipo === 'consulta' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'">
              {{ evento.title }}
            </div>
          </div>
          <div v-else class="text-gray-400 text-sm">Libre</div>
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

  const horasManana = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '13:00', '13:30']
  const horasTarde = ['16:00', '16:30', '17:00', '17:30', '18:00', '18:30', '19:00', '19:30']
  const horas = [...horasManana, ...horasTarde]

  const agendaPorHora = ref({})

  const fetchEvents = async () => {
    const today = new Date().toISOString().slice(0, 10)

    const data = [
      { id: 1, title: 'Consulta con Max', tipo: 'consulta', start: today + 'T09:00:00' },
      { id: 2, title: 'Vacunación de Luna', tipo: 'servicio', start: today + 'T09:30:00' },
      { id: 3, title: 'Control de peso a Rocky', tipo: 'consulta', start: today + 'T11:00:00' },
      { id: 4, title: 'Corte de uñas de Coco', tipo: 'servicio', start: today + 'T16:00:00' },
      { id: 5, title: 'Chequeo general a Nala', tipo: 'consulta', start: today + 'T18:30:00' },
    ]

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
  }

  onMounted(fetchEvents)

  // Paginación
  const paginaActual = ref(1)
  const porPagina = 10

  const totalPaginas = Math.ceil(horas.length / porPagina)

  const horasPaginadas = computed(() => {
    const start = (paginaActual.value - 1) * porPagina
    return horas.slice(start, start + porPagina)
  })

  //Hora y fecha actual:
  const horaActual = ref('')
const fechaActual = ref('')

// Actualitzar hora y fecha
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
