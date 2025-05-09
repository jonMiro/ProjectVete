<script setup>
import FooterWorkers from '@/Components/FooterWorkers.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';

defineProps({
  post: Object,
});
</script>

<template>
  <AppLayout title="Panel de Usuario">
    <template #header>
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight px-4 sm:px-6">
        Comunidad
      </h2>
    </template>

    <div class="min-h-screen flex flex-col">
      <!-- Contenido principal -->
      <div class="flex-grow container mx-auto mt-4 px-4">
        <div class="bg-white shadow-sm rounded-lg p-6">
          <h1 class="text-2xl font-semibold text-gray-800 mb-4">{{ post.titulo }}</h1>
          <p class="text-sm text-gray-600 mb-2">
            <strong>Autor:</strong> {{ post.user.name }} {{ post.user.apellidos }}
          </p>
          <p class="text-sm text-gray-600 mb-4">
            <strong>Tipo:</strong> {{ post.tipo }}
          </p>
          <div class="text-lg text-gray-800">
            <p>{{ post.contenido }}</p>
          </div>
        </div>
      </div>

ç      <FooterWorkers />
    </div>
  </AppLayout>
</template>
