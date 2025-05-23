<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import PostsBar from '@/Components/PostsBar.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import NavBar from '@/Components/NavBar.vue';

defineProps({
  guias: Array,
  anuncios: Array,
  experiencias: Array,
});

const truncateContent = (content, wordLimit = 15) => {
  const words = content.split(' ');
  return words.length > wordLimit ? words.slice(0, wordLimit).join(' ') + '...' : content;
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

const eliminarPost = (id) => {
  if (confirm("¿Estás seguro de que deseas eliminar este post?")) {
    Inertia.delete(route('postsworkers.destroy', id), {
      onSuccess: () => {
        alert("¡Post eliminado correctamente!");
        Inertia.visit(route('postsworkers.index'));
      },
      onError: (errors) => {
        console.log(errors);
      },
    });
  }
};
</script>

<template>
  <AppLayout title="Panel de Posts">
    <template #header>
      <NavBar />
    </template>

    <div class="min-h-screen flex flex-col">
      <div class="flex-grow container max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
        <PostsBar />

        <div v-if="categorias.some(cat => cat.posts.length > 0)"
             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-6">
          <template v-for="(categoria, catIndex) in categorias" :key="catIndex">
            <div v-for="post in categoria.posts" :key="post.id"
                 :class="[
                   'border-l-4 sm:border-l-8 bg-gray-50 shadow rounded-lg p-4 sm:p-5 relative flex flex-col justify-between',
                   {
                     'border-blue-500': categoria.color === 'blue',
                     'border-yellow-500': categoria.color === 'yellow',
                     'border-green-500': categoria.color === 'green',
                   }
                 ]">
              <div>
                <h5 class="text-base sm:text-lg font-bold text-gray-800 mb-1 sm:mb-2">{{ post.titulo }}</h5>
                <p class="text-xs sm:text-sm text-gray-600 mb-1"><strong>Tipo:</strong> {{ post.tipo }}</p>
                <p class="text-xs sm:text-sm text-gray-600 mb-2"><strong>Autor:</strong> {{ post.user.name }} {{ post.user.apellidos }}</p>
                <p class="text-xs sm:text-sm text-gray-600 mb-2"><strong>Fecha:</strong> {{ formatFecha(post.created_at) }}</p>
                <p class="text-sm text-gray-700 mb-3">{{ truncateContent(post.contenido) }}</p>
                <div v-if="post.imagen">
                  <img :src="`/storage/${post.imagen}`" alt="Imagen del post"
                       class="w-full aspect-video object-cover rounded" />
                </div>
              </div>
              <div class="flex justify-between mt-4">
                <div>
                  <Link :href="route('posts.edit', post.id)" class="text-sm text-gray-600 font-medium hover:underline">
                    Editar
                  </Link>
                  <button @click="eliminarPost(post.id)"
                          class="text-sm text-red-600 font-medium hover:underline ml-4">
                    Eliminar
                  </button>
                </div>
                <Link :href="route('posts.show', post.id)"
                      class="text-sm text-blue-600 font-medium hover:underline">
                  Leer más →
                </Link>
              </div>
            </div>
          </template>
        </div>

        <p v-else class="text-center text-base sm:text-lg text-gray-500 mt-10">No hay posts registrados.</p>
      </div>

      <FooterWorkers />
    </div>
  </AppLayout>
</template>
