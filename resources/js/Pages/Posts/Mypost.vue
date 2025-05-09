<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PostsBar from '@/Components/PostsBar.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  guias: Array,
  anuncios: Array,
  experiencias: Array,
});

// truncate
const limitContent = (content, wordLimit = 30) => {
  const words = content.split(' ');
  return words.length > wordLimit ? words.slice(0, wordLimit).join(' ') + '...' : content;
};

// Eliminar post
const eliminarPost = (id) => {
  if (confirm("¿Estás seguro de que deseas eliminar este post?")) {
    Inertia.delete(route('posts.destroy', id), {
      onSuccess: () => {
        alert("¡Post eliminado correctamente!");
        Inertia.visit(route('posts.index'));
      },
      onError: (errors) => {
        console.log(errors);
      },
    });
  }
};

const formatFecha = (fechaStr) => {
  const fecha = new Date(fechaStr);
  return fecha.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
};

const categorias = [
  { nombre: 'Guías', posts: __props.guias, color: 'blue' },
  { nombre: 'Anuncios', posts: __props.anuncios, color: 'yellow' },
  { nombre: 'Experiencias', posts: __props.experiencias, color: 'green' },
];
</script>

<template>
  <AppLayout title="Panel de Posts">
    <template #header>
      <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight px-4 sm:px-6">
        Mis Posts
      </h2>
    </template>

    <div class="container mx-auto mt-4 px-4">
      <PostsBar />

      <div v-if="categorias.some(cat => cat.posts.length > 0)"
           class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        <template v-for="(categoria, catIndex) in categorias" :key="catIndex">
          <div v-for="post in categoria.posts" :key="post.id"
               :class="`border-l-4 sm:border-l-8 border-${categoria.color}-500 bg-gray-50 shadow rounded-lg p-4 sm:p-5 relative flex flex-col justify-between`">
            <div>
              <h5 class="text-base sm:text-lg font-bold text-gray-800 mb-1 sm:mb-2">{{ post.titulo }}</h5>
              <p class="text-xs sm:text-sm text-gray-600 mb-1"><strong>Tipo:</strong> {{ post.tipo }}</p>
              <p class="text-xs sm:text-sm text-gray-600 mb-2"><strong>Autor:</strong> {{ post.user.name }} {{ post.user.apellidos }}</p>
              <p class="text-xs sm:text-sm text-gray-600 mb-2"><strong>Fecha:</strong> {{ formatFecha(post.created_at) }}</p>
              <p class="text-sm text-gray-700 mb-3">{{ limitContent(post.contenido) }}</p>
              <div v-if="post.imagen">
                <img :src="`/storage/${post.imagen}`" alt="Imagen del post"
                     class="w-full aspect-video object-cover rounded" />
              </div>
            </div>
            <div class="flex justify-between mt-4">
              <div>
                <Link :href="route('posts.edit', post.id)"
                      :class="`text-sm text-gray-600 font-medium hover:underline`">
                  Editar
                </Link>
                <button @click="eliminarPost(post.id)"
                        class="text-sm text-red-600 font-medium hover:underline ml-4">
                  Eliminar
                </button>
              </div>
              <Link :href="route('posts.show', post.id)"
                    :class="`text-sm text-blue-600 font-medium hover:underline`">
                Leer más →
              </Link>
            </div>
          </div>
        </template>
      </div>

      <p v-else class="text-center text-lg text-gray-500">No hay posts registrados.</p>
    </div>

    <FooterWorkers />
  </AppLayout>
</template>
