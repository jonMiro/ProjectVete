<template>
    <div class="calendar-container">
      <FullCalendar :options="calendarOptions" />
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
        alert('Fecha clickeada: ' + arg.dateStr)
      }

      return {
        calendarOptions
      }
    }
  }
  </script>

  <style scoped>
  .calendar-container {
    width: 100%;
    height: 100%;
    /* Ajusta el tamaño del calendario */
    max-width: 800px;  /* Puedes cambiar esto para hacer el calendario más pequeño */
    margin: 0 auto;
  }
  </style>
