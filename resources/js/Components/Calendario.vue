<template>
    <div class="calendar-container">
      <FullCalendar :options="calendarOptions" />

      <!-- Modal para mostrar los eventos del día -->
      <div v-if="showModal" class="modal-overlay" @click="closeModal">
        <div class="modal-content" @click.stop>
          <h3>Eventos para el día {{ selectedDate }}</h3>
          <ul>
            <li v-for="event in eventsOnSelectedDate" :key="event.id">
              <strong>{{ event.title }}</strong>
              <p>{{ event.description }}</p>
              <p>Tipo: {{ event.tipo }}</p>
              <p>Precio: {{ event.precio || 'Por determinar' }}</p>
            </li>
          </ul>
          <button @click="closeModal">Cerrar</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import { ref, onMounted, watch } from 'vue'

  export default {
    components: {
      FullCalendar
    },
    setup() {
      const events = ref([])  // Declaramos los eventos
      const showModal = ref(false)  // Para mostrar/ocultar el modal
      const selectedDate = ref('')  // Fecha seleccionada
      const eventsOnSelectedDate = ref([])  // Eventos del día seleccionado

      // Función para obtener los eventos desde la API
      const fetchEvents = async () => {
        try {
          const response = await fetch('/api/events')  // Llamada a la API
          const data = await response.json()
          // Formateamos los datos para FullCalendar
          events.value = data.map(event => ({
            id: event.id,
            title: event.title,
            start: event.start,
            end: event.end || event.start,  // Si no hay "end", lo usamos como "start"
            description: event.descripcion,  // Puedes agregar otros campos si los necesitas
            tipo: event.tipo,  // El tipo de evento
            precio: event.precio  // El precio
          }))
        } catch (error) {
          console.error('Error fetching events:', error)
        }
      }

      // Llamamos a la API cuando se monta el componente
      onMounted(fetchEvents)

      const calendarOptions = ref({
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        events: [],  // Inicializamos eventos como un array vacío
        eventClick: handleEventClick,  // Manejar clic en evento
        dateClick: handleDateClick,  // Manejar clic en fecha
      })

      // Actualizar los eventos cuando se obtienen nuevos datos
      watch(events, (newEvents) => {
        calendarOptions.value.events = newEvents  // Actualizamos los eventos en calendarOptions
      })

      // Función cuando se hace clic en un evento
      function handleEventClick(info) {
        alert(`Evento: ${info.event.title}\nTipo: ${info.event.extendedProps.tipo}\nPrecio: ${info.event.extendedProps.precio || 'Por determinar'}`)
      }

      // Función cuando se hace clic en una fecha
      function handleDateClick(arg) {
        selectedDate.value = arg.dateStr  // Guardamos la fecha seleccionada
        // Filtramos los eventos para mostrar solo los que ocurren en esta fecha
        eventsOnSelectedDate.value = events.value.filter(event => {
          const eventDate = new Date(event.start).toLocaleDateString()
          return eventDate === arg.dateStr
        })
        showModal.value = true  // Mostramos el modal
      }

      // Función para cerrar el modal
      function closeModal() {
        showModal.value = false
      }

      return {
        calendarOptions,
        showModal,
        selectedDate,
        eventsOnSelectedDate,
        closeModal
      }
    }
  }
  </script>

  <style scoped>
  .calendar-container {
    width: 100%;
    height: 100%;
    max-width: 800px;
    margin: 0 auto;
  }

  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    width: 400px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  button {
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #0056b3;
  }
  </style>
