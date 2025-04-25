<template>
    <AppLayout title="Estadísticas">
      <template #header>
        <NavBar />
      </template>

      <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-10">Estadísticas de Consultas y Servicios</h1>

        <!-- Contadores Generales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-6 mb-10">
          <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold">Consultas</h2>
            <p class="text-3xl">{{ consultasCount }}</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold">Servicios</h2>
            <p class="text-3xl">{{ serviciosCount }}</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold">Animales</h2>
            <p class="text-3xl">{{ animalesCount }}</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold">Usuarios</h2>
            <p class="text-3xl">{{ usuariosCount }}</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold">Facturación</h2>
            <p class="text-3xl">{{ facturacionTotal.toLocaleString('es-ES') }} €</p>
          </div>
        </div>

        <!-- Gráficos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
          <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-center mb-4">Animales por Tipo</h2>
            <AnimalesPorTipoChart :animalesPorTipo="animalesPorTipo" class="h-64" />
          </div>

          <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-center mb-4">Servicios y Consultas</h2>
            <ServiciosConsultasChart :consultasCount="consultasCount" :serviciosCount="serviciosCount" class="h-64" />
          </div>

          <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-center mb-4">Usuarios por Tipo</h2>
            <TiposUsuarioChart :usuariosPorTipo="usuariosPorTipo" class="h-64" />
          </div>

          <div class="bg-white p-4 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-center mb-4">Facturación Mensual</h2>
            <FacturacionMensualChart :facturacionMensual="facturacionMensual" class="h-64" />
          </div>
        </div>
      </div>

      <Footer />
    </AppLayout>
  </template>

  <script setup>
  import { defineProps } from 'vue';
  import AnimalesPorTipoChart from '@/Components/AnimalesPorTipoChart.vue';
  import ServiciosConsultasChart from '@/Components/ServiciosConsultasChart.vue';
  import FacturacionMensualChart from '@/Components/FacturacionMensualChart.vue';
  import TiposUsuarioChart from '@/Components/TiposUsuarioChart.vue';
  import AppLayout from '@/Layouts/AppLayout.vue';
  import NavBar from '@/Components/NavBar.vue';
  import Footer from '@/Components/Footer.vue';

  const props = defineProps({
    consultasCount: Number,
    serviciosCount: Number,
    usuariosCount: Number,
    animalesCount: Number,
    facturacionTotal: Number,
    animalesPorTipo: Array,
    facturacionMensual: Array,
    usuariosPorTipo: Array
  });
  </script>
