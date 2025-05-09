<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import PostsBar from '@/Components/PostsBar.vue';

const props = defineProps({
  post: Object,
});

const form = useForm({
  titulo: props.post.titulo,
  contenido: props.post.contenido,
  tipo: props.post.tipo,
  imagen: null,
});

const tipos = ['guia', 'anuncio', 'experiencia'];

// submit editar
const submit = () => {
  form.put(route('posts.update', props.post.id), {
    onSuccess: () => {
      window.location.href = '/clients/posts/myposts';
    },
  });
};

// event imagen
const handleFileChange = (event) => {
  form.imagen = event.target.files[0];
};

// Cargar la imagen actual si existe
onMounted(() => {
  if (props.post.imagen) {
    form.imagen = props.post.imagen;
  }
});
</script>

<template>
  <AppLayout title="Editar Post">
    <template #header>
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight px-4 sm:px-6">
          Editar Post
        </h2>
    </template>

    <div class="container mx-auto mt-4 px-4">
      <PostsBar />

      <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg mt-6">
        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="titulo" class="block text-sm font-semibold text-gray-700">Título</label>
            <input
              type="text"
              id="titulo"
              v-model="form.titulo"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md"
              required
            />
          </div>

          <div class="mb-4">
            <label for="contenido" class="block text-lg font-semibold text-gray-700">Contenido</label> <!-- Aumenté el tamaño aquí -->
            <textarea
              id="contenido"
              v-model="form.contenido"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md"
              rows="4"
              required
            ></textarea>
          </div>

          <div class="mb-4">
            <label for="tipo" class="block text-sm font-semibold text-gray-700">Tipo de Post</label>
            <select
              id="tipo"
              v-model="form.tipo"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md"
              required
            >
              <option v-for="tipo in tipos" :key="tipo" :value="tipo">{{ tipo }}</option>
            </select>
          </div>

          <div class="mb-4">
            <label for="imagen" class="block text-sm font-semibold text-gray-700">Imagen (opcional)</label>
            <input
              type="file"
              id="imagen"
              @change="handleFileChange"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md"
              accept="image/*"
            />
          </div>

          <div class="mb-4">
            <button
              type="submit"
              class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"
            >
              Guardar Cambios
            </button>
          </div>
        </form>
      </div>
    </div>

    <FooterWorkers />
  </AppLayout>
</template>
