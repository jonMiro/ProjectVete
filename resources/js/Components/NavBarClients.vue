<template>
    <nav class="bg-gray-600 p-3">
      <div class="container mx-auto flex justify-between items-center">
        <ul class="flex space-x-10 justify-end w-full">
            <li class="nav-item">

          <Link href="" class="nav-link text-white hover:text-blue-400 text-lg">Conócenos</Link>
        </li>
        <li class="nav-item">
            <Link :href="route('animales.index')" class="nav-link text-white hover:text-blue-400 text-lg">Contacto</Link>
          </li>
          <li class="nav-item">
            <Link :href="route('users.index')" class="nav-link text-white hover:text-blue-400 text-lg">LLamar</Link>
          </li><!--
          <li class="nav-item">
            <Link href="/clientes" class="nav-link text-white hover:text-blue-400 text-lg">Clientes</Link>
          </li>

          <li class="nav-item">
            <Link href="/servicios" class="nav-link text-white hover:text-blue-400 text-lg">Servicios</Link>
          </li>-->
          <!-- Admin con margen y color verde -->
        </ul>
      </div>
    </nav>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>

  <style scoped>
  /* Aquí puedes añadir más estilos personalizados si es necesario */
  </style>
