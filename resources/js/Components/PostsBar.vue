<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex flex-col items-center gap-4 pt-4 px-8">
    <h1 class="text-2xl font-bold mb-2">COMUNIDAD</h1> 

    <div class="flex flex-row space-x-4">
      <Link
        href="/clients/posts"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg text-center"
      >
        📚 Ver todos los Posts
      </Link>

      <Link
        href="/clients/posts/myposts"
        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg text-center"
      >
        📝 Ver Mis Posts
      </Link>

      <Link
        href="/clients/posts/create"
        class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg text-center"
      >
        ➕ Crear Nuevo Post
      </Link>
    </div>
  </div>
</template>
