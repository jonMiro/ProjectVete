<template>
    <nav class="bg-gray-600 p-3">
      <div class="container mx-auto flex justify-between items-center">
        <ul class="flex space-x-10 justify-center w-full">
            <li class="nav-item">
          <!-- Asegúrate de usar `route()` para generar la URL -->
          <Link :href="route('search.index')" class="nav-link text-white hover:text-blue-400 text-lg">Buscar</Link>
        </li>
        <li class="nav-item">
            <Link :href="route('animales.index')" class="nav-link text-white hover:text-blue-400 text-lg">Animales</Link>
          </li>
          <li class="nav-item">
            <Link :href="route('users.index')" class="nav-link text-white hover:text-blue-400 text-lg">Usuarios</Link>
          </li>
          <li class="nav-item">
            <Link :href="route('consultas.index')" class="nav-link text-white hover:text-blue-400 text-lg">Consultas</Link>
          </li>

          <li class="nav-item">
            <Link :href="route('servicios.index')" class="nav-link text-white hover:text-blue-400 text-lg">Servicios</Link>
          </li>

          <li class="nav-item">
            <Link href="" class="nav-link text-white hover:text-blue-400 text-lg">Facturación</Link>
          </li>

          <li class="nav-item">
            <Link href="" class="nav-link text-white hover:text-blue-400 text-lg">DataAnalisis</Link>
          </li>


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
