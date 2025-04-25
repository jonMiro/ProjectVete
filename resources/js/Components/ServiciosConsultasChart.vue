<template>
    <div v-if="consultasCount && serviciosCount" class="flex justify-center items-center">
      <canvas ref="chart"></canvas>
    </div>
    <div v-else>
      <p>No hay datos disponibles para mostrar el gráfico.</p>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import { Chart, ArcElement, Title, Tooltip, Legend, PieController } from 'chart.js'; // Registrar PieController y ArcElement

  const props = defineProps({
    consultasCount: Number,
    serviciosCount: Number,
  });

  const chart = ref(null);
  let chartInstance = null; // Para almacenar la instancia del gráfico

  // Registrar los elementos y controladores necesarios para el gráfico de pie
  Chart.register(PieController, ArcElement, Title, Tooltip, Legend);

  // Función para renderizar el gráfico
  const renderChart = () => {
    const ctx = chart.value.getContext('2d');

    // Destruir el gráfico anterior si existe
    if (chartInstance) {
      chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
      type: 'pie', // Gráfico de pastel
      data: {
        labels: ['Consultas', 'Servicios'],
        datasets: [{
          label: 'Cantidad',
          data: [props.consultasCount, props.serviciosCount],
          backgroundColor: ['#FF6384', '#36A2EB'],
          borderColor: ['#FF6384', '#36A2EB'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Servicios y Consultas'
          }
        }
      }
    });
  };

  // Inicializar el gráfico cuando el componente se monte
  onMounted(() => {
    renderChart();
  });

  // Observar cambios en las props y volver a renderizar el gráfico
  watch([() => props.consultasCount, () => props.serviciosCount], () => {
    if (chartInstance) {
      chartInstance.destroy(); // Destruir el gráfico anterior
      renderChart(); // Volver a renderizar el gráfico
    }
  });
  </script>

  <style scoped>
  canvas {
    max-width: 100%;
  }
  </style>
