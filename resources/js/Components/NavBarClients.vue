<template>
    <!-- NAV MOBILE: Bottom bar -->
    <nav class="fixed bottom-0 inset-x-0 bg-white border-t shadow-md sm:hidden z-50">
      <ul class="flex justify-around items-center py-2">
        <li>
          <Link href="user/profile" class="flex flex-col items-center text-xs text-gray-700 hover:text-blue-500">
            <img src="/icons/profile.png" class="w-6 h-6 mb-1" />
            Perfil
          </Link>
        </li>
        <li>
          <Link :href="route('clients.animales.index')" class="flex flex-col items-center text-xs text-gray-700 hover:text-blue-500">
            <img src="/icons/pet.png" class="w-6 h-6 mb-1" />
            Mascotas
          </Link>
        </li>
        <li>
          <Link :href="route('clients.historial.index')" class="flex flex-col items-center text-xs text-gray-700 hover:text-blue-500">
            <img src="/icons/consultas.png" class="w-6 h-6 mb-1" />
            Consultas
          </Link>
        </li>
        <li>
          <Link href="/clients/eventos/create" class="flex flex-col items-center text-xs text-gray-700 hover:text-blue-500">
            <img src="/icons/social.png" class="w-6 h-6 mb-1" />
            Servicios
          </Link>
        </li>
        <li>
          <Link :href="route('posts.index')" class="flex flex-col items-center text-xs text-gray-700 hover:text-blue-500">
            <img src="/icons/social.png" class="w-6 h-6 mb-1" />
            Comunidad
          </Link>
        </li>
      </ul>
    </nav>

    <!-- NAV DESKTOP -->
    <nav class="hidden sm:flex bg-gray-700 text-white py-3 px-6 justify-center space-x-8 shadow-md">
      <Link href="user/profile" class="hover:text-blue-400">Perfil</Link>
      <Link :href="route('clients.animales.index')" class="hover:text-blue-400">Mascotas</Link>
      <Link :href="route('clients.historial.index')" class="hover:text-blue-400">Consultas</Link>
      <Link href="/clients/eventos/create" class="hover:text-blue-400">Servicios</Link>
      <Link :href="route('posts.index')" class="hover:text-blue-400">Comunidad</Link>
      <span class="text-gray-400 cursor-not-allowed">Tienda (pronto)</span>
    </nav>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>
