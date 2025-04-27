<script setup>
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import PostsBar from '@/Components/PostsBar.vue';

defineProps({
  guias: Array,
  anuncios: Array,
  experiencias: Array,
});

// Tabla/grid
const isListView = ref(false);

// limit 15 palabrad
const limitContent = (content, wordLimit = 30) => {
  const words = content.split(' ');
  return words.length > wordLimit ? words.slice(0, wordLimit).join(' ') + '...' : content;
};
</script>

<template>
  <AppLayout title="Panel de Posts">
    <template #header>
    </template>

    <div class="container mx-auto mt-4 px-4">
      <PostsBar />


      <!-- Checkbox modo grid y tabla -->
      <div class="flex items-center justify-center mb-6">
        <label for="toggle-view" class="mr-2 text-lg">Modo de vista</label>
        <input
          type="checkbox"
          id="toggle-view"
          v-model="isListView"
          class="h-4 w-4"
        />
        <span class="ml-2">Modo Grid / Modo Tabla</span>
      </div>

      <!-- Mmodo grid -->
      <div v-if="isListView && (guias.length > 0 || anuncios.length > 0 || experiencias.length > 0)" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Guias -->
        <div v-for="post in guias" :key="post.id" class="bg-white shadow-lg rounded-lg overflow-hidden">
          <div class="p-6">
            <h5 class="text-xl font-semibold text-blue-500 mb-4">ID Post: {{ post.id }}</h5>
            <p class="text-lg"><strong>Título:</strong> {{ post.titulo }}</p>
            <p class="text-lg"><strong>Tipo:</strong> {{ post.tipo }}</p>
            <p class="text-lg"><strong>Contenido:</strong> {{ limitContent(post.contenido) }}</p>

            <!-- Información del autor -->
            <p class="text-lg"><strong>Autor:</strong> {{ post.user.name }} {{ post.user.apellidos }}</p>

            <!-- Imagen del post -->
            <div v-if="post.imagen" class="mt-4">
              <img :src="`/storage/${post.imagen}`" alt="Imagen del post" class="w-full h-48 object-cover rounded-lg shadow-md" />
            </div>
          </div>

          <div class="bg-gray-100 text-center py-4">
            <Link :href="route('posts.show', post.id)" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Mostrar</Link>
          </div>
        </div>


      </div>

      <!-- Modo Tabla -->
      <div v-else-if="!isListView && (guias.length > 0 || anuncios.length > 0 || experiencias.length > 0)">
        <table class="table-auto w-full text-center border-collapse">
          <thead class="bg-blue-100">
            <tr>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">ID Post</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Título</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Tipo</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Contenido</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Autor</th>
              <th class="px-4 py-2 border-b-2 border-blue-400 text-gray-700">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in guias" :key="post.id" class="hover:bg-blue-50">
              <td class="border px-4 py-2">{{ post.id }}</td>
              <td class="border px-4 py-2">{{ post.titulo }}</td>
              <td class="border px-4 py-2">{{ post.tipo }}</td>
              <td class="border px-4 py-2">{{ limitContent(post.contenido) }}</td>
              <td class="border px-4 py-2">{{ post.user.name }} {{ post.user.apellidos }}</td>
              <td class="border px-4 py-2">
                <Link :href="route('posts.show', post.id)" class="bg-blue-500 text-white text-sm py-1 px-1 rounded-lg hover:bg-blue-600">Mostrar</Link>
              </td>
            </tr>
            <!-- Afegir experiencies y anuncis -->
          </tbody>
        </table>
      </div>

      <!-- Si no hay posts...-->
      <p v-else class="text-center text-lg text-gray-500">No hay posts registrados.</p>
    </div>
  </AppLayout>
</template>
