<template>
  <nav class="flex flex-row justify-around items-center p-4 bg-white rounded-2xl shadow-md w-full block md:hidden">
    <!-- Elemento 1: Mi perfil -->
    <Link
      :href="route('profile.show')"
      class="flex flex-col items-center"
      :class="linkClass('profile.show')"
    >
      <img src="/icons/profile.png" alt="Logo Perfil" class="w-10 h-10 mb-1" />
      <span class="text-xs font-medium">Mi perfil</span>
    </Link>


    <!-- Elemento 2: Mis mascotas -->
    <Link
      :href="route('clients.animales.index')"
      class="flex flex-col items-center"
      :class="linkClass('clients.animales.index')"
    >
      <img src="/icons/pet.png" alt="Logo Mascota" class="w-10 h-10 mb-1" />
      <span class="text-xs font-medium">Mis mascotas</span>
    </Link>

    <!-- Elemento 3: Comunidad -->
    <Link
      :href="route('posts.index')"
      class="flex flex-col items-center"
      :class="linkClass('posts.index')"
    >
      <img src="/icons/social.png" alt="Logo Comunidad" class="w-10 h-10 mb-1" />
      <span class="text-xs font-medium">Comunidad</span>
    </Link>

    <!-- Elemento 4: Servicios -->
    <Link
      :href="route('eventos.create')"
      class="flex flex-col items-center"
      :class="linkClass('eventos.create')"
    >
      <img src="/icons/servicios.png" alt="Logo Servicios" class="w-10 h-10 mb-1" />
      <span class="text-xs font-medium">Servicios</span>
    </Link>

    <!-- Elemento 5: Historial -->
    <Link
      :href="route('clients.historial.index')"
      class="flex flex-col items-center"
      :class="linkClass('clients.historial.index')"
    >
      <img src="/icons/consultas.png" alt="Logo Consulta" class="w-10 h-10 mb-1" />
      <span class="text-xs font-medium">Historial</span>
    </Link>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

const linkClass = (name) => {
  return route().current(name)
    ? 'text-blue-400 border-b-2 text-lg'
    : 'text-white hover:text-blue-400 text-lg';
};
</script>
