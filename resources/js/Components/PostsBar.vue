<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="flex flex-row justify-center items-center gap-4 pt-4 px-8">
    <Link
      href="/clients/posts"
      class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg flex flex-col items-center text-center w-24"
    >
      <span class="text-xl">📚</span>
      <span class="text-xs sm:text-sm mt-1">Todos</span>
    </Link>

    <Link
      href="/clients/posts/myposts"
      class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg flex flex-col items-center text-center w-24"
    >
      <span class="text-xl">📝</span>
      <span class="text-xs sm:text-sm mt-1">Mis Posts</span>
    </Link>

    <Link
      href="/clients/posts/create"
      class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg flex flex-col items-center text-center w-24"
    >
      <span class="text-xl">➕</span>
      <span class="text-xs sm:text-sm mt-1">Nuevo</span>
    </Link>
  </div>
</template>
