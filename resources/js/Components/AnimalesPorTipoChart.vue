<template>
    <div v-if="animalesPorTipo.length > 0">
      <canvas ref="chart"></canvas>
    </div>
    <div v-else>
      <p>No hay datos disponibles para mostrar el gráfico.</p>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import { Chart, CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend, BarController } from 'chart.js';

  const props = defineProps({
    animalesPorTipo: Array,
  });

  const chart = ref(null);
  let chartInstance = null; // Emmagatzemar instancia de tabla

  // registrar chart js elements
  Chart.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
    BarController
  );

  //renderiyzem el grafic en 2D
  const renderChart = () => {
    const ctx = chart.value.getContext('2d');

    // Actualitzem el chart (destruint el anterior)
    if (chartInstance) {
      chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: props.animalesPorTipo.map(item => item.tipo),
        datasets: [{
          label: 'Cantidad de Animales',
          data: props.animalesPorTipo.map(item => item.total),
          backgroundColor: '#42A5F5',
          borderColor: '#1E88E5',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Distribución de Animales por Tipo'
          }
        }
      }
    });
  };

  // renderitzem el chart
  onMounted(() => {
    renderChart();
  });

  // Este watch compara la info actual en la antiga i la actualitza
  watch(() => props.animalesPorTipo, (newValue, oldValue) => {
    if (newValue !== oldValue) {
      renderChart();
    }
  });
  </script>

  <style scoped>
  canvas {
    max-width: 100%;
  }
  </style>
