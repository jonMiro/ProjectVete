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
  let chartInstance = null; // Para almacenar la instancia del gráfico

  // Registrar los elementos de Chart.js
  Chart.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
    BarController  // Registrar el controlador de 'bar'
  );

  // Función para renderizar el gráfico
  const renderChart = () => {
    const ctx = chart.value.getContext('2d');

    // Destruir el gráfico anterior si ya existe
    if (chartInstance) {
      chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
      type: 'bar', // Gráfico de barras
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

  // Inicializar el gráfico cuando el componente se monte
  onMounted(() => {
    renderChart();
  });

  // Observar cambios en los datos y actualizar el gráfico si es necesario
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
