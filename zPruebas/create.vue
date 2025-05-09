<template>
    <div>
      <!-- Fecha -->
      <label class="block mb-1 font-semibold">Fecha</label>
      <input type="date" :value="fechaDate" @input="updateFecha" class="w-full border rounded px-3 py-2" />
    </div>

    <div>
      <!-- Hora -->
      <label class="block mb-1 font-semibold">Inicio (Hora)</label>
      <input type="time" v-model="hora" class="w-full border rounded px-3 py-2" />
    </div>

    <div>
      <!-- Campo construido de Fecha + Hora -->
      <label class="block mb-1 font-semibold">Fecha y Hora (Start)</label>
      <input type="text" :value="start" readonly class="w-full border rounded px-3 py-2" />
    </div>
  </template>

  <script setup>
  import { ref, computed } from 'vue';

  // Definir las propiedades de fecha y hora
  const fecha = ref('');
  const hora = ref('08:00'); // Hora predeterminada (puedes cambiarla si lo deseas)

  // Computado que construye la fecha y hora en 'start', con formato YYYY-MM-DD
  const start = computed(() => {
    if (fecha.value && hora.value) {
      // Asegurarnos de que la fecha está en el formato DD-MM-YYYY
      const [day, month, year] = fecha.value.split('-');

      // Cambiar el formato a YYYY-MM-DD
      return `${year}-${month}-${day} ${hora.value}`; // Formato yyyy-mm-dd hh:mm
    }
    return '';
  });

  // Computado para convertir el valor de 'fecha' a 'YYYY-MM-DD' para el input type="date"
  const fechaDate = computed(() => {
    if (fecha.value) {
      const [day, month, year] = fecha.value.split('-');
      return `${year}-${month}-${day}`; // Convertir a formato YYYY-MM-DD
    }
    return '';
  });

  // Métodos para actualizar fecha y hora
  const updateFecha = (event) => {
    const date = event.target.value;  // El valor es del tipo YYYY-MM-DD
    const [year, month, day] = date.split('-');
    fecha.value = `${day}-${month}-${year}`;  // Convertirlo a DD-MM-YYYY
  };

  const updateHora = (event) => {
    hora.value = event.target.value;
  };
  </script>
