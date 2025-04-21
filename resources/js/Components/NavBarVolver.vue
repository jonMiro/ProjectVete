<template>
    <!-- Navegación interna -->
    <nav class="bg-gray-600 p-3">
      <div class="container mx-auto flex justify-between items-center">
        <ul class="flex space-x-10 justify-center w-full">
          <li class="nav-item">
            <Link :href="route('dashboard')">
                <a href="#portal" class="nav-link text-white hover:text-blue-400 text-lg">Volver</a>
                                </Link>

          </li>
        </ul>
      </div>
    </nav>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>

  <style scoped>
  /* Aquí puedes añadir más estilos personalizados si es necesario */
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
