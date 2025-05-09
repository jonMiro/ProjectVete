<template>
    <nav class="bg-gray-700 p-3">
      <div class="container mx-auto flex justify-between items-center">
        <ul class="flex space-x-10 justify-center w-full">
          <li class="nav-item">
            <a href="#portal" class="nav-link text-white hover:text-blue-400 text-lg">Portal</a>
          </li>
          <li class="nav-item">
            <a href="#servicios" class="nav-link text-white hover:text-blue-400 text-lg">Servicios</a>
          </li>
          <li class="nav-item">
            <a href="#horarios" class="nav-link text-white hover:text-blue-400 text-lg">Horarios</a>
          </li>
          <li class="nav-item">
            <a href="#contacto" class="nav-link text-white hover:text-blue-400 text-lg">Contacto</a>
          </li>
        </ul>
      </div>
    </nav>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>

  <style scoped>
  .nav-link {
    font-weight: 600;
    transition: color 0.3s ease;
  }

  .nav-item {
    display: inline-block;
  }

  .nav-item a {
    text-decoration: none;
  }
  </style>
