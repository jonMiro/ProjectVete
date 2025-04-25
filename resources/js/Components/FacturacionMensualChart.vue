<template>
    <div v-if="facturacionMensual.length">
      <canvas ref="chart"></canvas>
    </div>
    <div v-else>
      <p>No hay datos disponibles para mostrar el gráfico de facturación mensual.</p>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import {
    Chart,
    CategoryScale,
    LinearScale,
    BarElement,
    Title,
    Tooltip,
    Legend,
  } from 'chart.js';

  const props = defineProps({
    facturacionMensual: Array
  });

  const chart = ref(null);
  let chartInstance = null;

  Chart.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend);

  const renderChart = () => {
    if (!chart.value || !props.facturacionMensual.length) return;

    const ctx = chart.value.getContext('2d');
    if (chartInstance) chartInstance.destroy();

    const labels = props.facturacionMensual.map(item => item.date);
    const datosConsultas = props.facturacionMensual.map(item => item.consulta);
    const datosServicios = props.facturacionMensual.map(item => item.servicio);

    chartInstance = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Consultas',
            data: datosConsultas,
            backgroundColor: '#42A5F5',
            borderColor: '#1E88E5',
            borderWidth: 1
          },
          {
            label: 'Servicios',
            data: datosServicios,
            backgroundColor: '#66BB6A',
            borderColor: '#388E3C',
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Facturación Mensual por Tipo'
          },
          legend: {
            position: 'bottom'
          }
        },
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  };

  onMounted(() => renderChart());
  watch(() => props.facturacionMensual, () => renderChart());
  </script>

  <style scoped>
  canvas {
    max-width: 100%;
  }
  </style>
