<template>
  <AppLayout title="Panel de Posts">
    <template #header>
      <h2 class="hidden lg:block font-semibold text-xl text-gray-800 leading-tight">
        Comunidad
      </h2>
      <NavClientsDashboard />
    </template>

    <div class="min-h-screen flex flex-col">
      <div class="flex-grow container max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8">
        <PostsBar />

        <!-- Filtros -->
        <div class="flex justify-center items-center flex-wrap gap-2 mt-6">
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="filtroActivo === 'todos' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="filtroActivo = 'todos'"
          >
            Todos
          </button>
          <button
            v-for="cat in categorias"
            :key="cat.key"
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :style="filtroActivo === cat.key ? { backgroundColor: cat.tailwindColor, color: 'white', borderColor: cat.tailwindColor } : { borderColor: '#e5e7eb', color: '#1f2937' }"
            @click="filtroActivo = cat.key"
          >
            {{ cat.nombre }}
          </button>

          <!-- Filtros de orden -->
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="ordenActivo === 'recientes' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="ordenActivo = 'recientes'"
          >
            Más recientes
          </button>
          <button
            class="px-4 py-1.5 rounded-full border text-sm font-medium transition"
            :class="ordenActivo === 'antiguas' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-800 border-gray-300 hover:bg-gray-100'"
            @click="ordenActivo = 'antiguas'"
          >
            Más antiguos
          </button>
        </div>

        <!-- Listado de posts -->
        <div
          v-if="postsFiltrados.some(cat => cat.posts.length > 0)"
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mt-6"
        >
          <template v-for="(categoria, catIndex) in postsFiltrados" :key="catIndex">
            <div
              v-for="post in categoria.posts"
              :key="post.id"
              class="border-l-4 sm:border-l-8 bg-gray-50 shadow rounded-lg p-4 sm:p-5 relative flex flex-col justify-between"
              :style="{ borderLeftColor: categoria.tailwindColor }"
            >
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
              <div class="mt-4 sm:mt-0 text-right">
                <Link :href="route('posts.show', post.id)"
                      class="text-sm text-blue-600 font-medium hover:underline">
                  Leer más →</Link>
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

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';
import PostsBar from '@/Components/PostsBar.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import NavClientsDashboard from '@/Components/NavClientsDashboard.vue'


const props = defineProps({
  posts: Array,
  filtroTipo: String,
  filtroOrden: String,
});

const categorias = [
  { nombre: 'Guías', key: 'guia', color: 'blue', tailwindColor: '#3B82F6' },
  { nombre: 'Anuncios', key: 'anuncio', color: 'yellow', tailwindColor: '#F59E0B' },
  { nombre: 'Experiencias', key: 'experiencia', color: 'green', tailwindColor: '#10B981' },
];

const filtroActivo = ref(props.filtroTipo ?? 'todos');
const ordenActivo = ref(props.filtroOrden ?? 'recientes');

const postsFiltrados = computed(() => {
  let posts = props.posts;


  if (ordenActivo.value === 'antiguas') {
    posts = posts.sort((a, b) => new Date(a.created_at) - new Date(b.created_at)); // Orden ascendente (más antiguos primero)
  } else {
    posts = posts.sort((a, b) => new Date(b.created_at) - new Date(a.created_at)); // Orden descendente (más recientes primero)
  }

  if (filtroActivo.value !== 'todos') {
    posts = posts.filter(post => post.tipo === filtroActivo.value);
  }

  return categorias.map(cat => ({
    ...cat,
    posts: posts.filter(post => post.tipo === cat.key),
  }));
});

const truncateContent = (content, wordLimit = 15) => {
  const words = content.split(' ');
  return words.length > wordLimit ? words.slice(0, wordLimit).join(' ') + '...' : content;
};

const formatFecha = (fechaStr) => {
  const fecha = new Date(fechaStr);
  return fecha.toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' });
};
</script>
