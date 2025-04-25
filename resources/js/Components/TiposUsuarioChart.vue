<template>
    <div v-if="usuariosPorTipo.length > 0" class="flex justify-center items-center">
      <canvas ref="chart"></canvas>
    </div>
    <div v-else>
      <p>No hay datos disponibles para mostrar el gráfico de usuarios por tipo.</p>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import { Chart, ArcElement, Tooltip, Legend, PieController } from 'chart.js';

  const props = defineProps({
    usuariosPorTipo: Array,
  });

  const chart = ref(null);
  let chartInstance = null;

  Chart.register(ArcElement, Tooltip, Legend, PieController);

  const renderChart = () => {
    const ctx = chart.value.getContext('2d');

    if (chartInstance) {
      chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: props.usuariosPorTipo.map(item => item.tipo),
        datasets: [{
          label: 'Cantidad de Usuarios',
          data: props.usuariosPorTipo.map(item => item.total),
          backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
          borderColor: ['#FF6384', '#36A2EB', '#FFCE56'],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Distribución de Usuarios por Tipo'
          }
        }
      }
    });
  };

  onMounted(() => {
    renderChart();
  });

  watch(() => props.usuariosPorTipo, (newValue) => {
    renderChart();
  });
  </script>

  <style scoped>
  canvas {
    max-width: 100%;
  }
  </style>
