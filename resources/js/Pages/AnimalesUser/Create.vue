<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const props = defineProps({
  user: Object,
});

const userId = props.user ? props.user.id : null;
const userName = props.user ? `${props.user.name} ${props.user.apellidos}` : null;

if (!userId) {
  console.error("El usuario no esta disponible actualmente");
}

// FormData
const form = useForm({
  nombre: '',
  tipo: '',
  raza: '',
  sexo: '',
  fechaNacimiento: '',
  user_id: userId,
  imagen: null,
  observaciones: '',
});

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.imagen = file;
  }
};

const submit = () => {
  const data = new FormData();

  data.append('nombre', form.nombre);
  data.append('tipo', form.tipo);
  data.append('raza', form.raza);
  data.append('sexo', form.sexo);
  data.append('fechaNacimiento', form.fechaNacimiento);
  data.append('user_id', form.user_id);
  data.append('observaciones', form.observaciones);

  // Imágen
  if (form.imagen) {
    data.append('imagen', form.imagen);
  }

  form.post(route('clients.animales.store'), {
    data,
    forceFormData: true,
    onSuccess: () => {
      alert("¡Animal registrado correctamente!");
      Inertia.visit(route('clients.animales.index'));
    },
    onError: (errors) => {
      console.log(errors);
    }
  });
};
</script>

<template>
  <AppLayout title="Alta de Registros">
    <div class="container mx-auto my-12 ">
      <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-lg mt-4">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Alta Animal</h2>

        <form @submit.prevent="submit">
          <div class="mb-4">
            <label for="nombre" class="block text-sm font-semibold text-gray-700">Nombre</label>
            <input
              type="text"
              id="nombre"
              v-model="form.nombre"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              required
            />
            <div v-if="form.errors.nombre" class="text-red-500 text-sm mt-1">{{ form.errors.nombre }}</div>
          </div>

          <div class="mb-4">
            <label for="tipo" class="block text-sm font-semibold text-gray-700">Tipo</label>
            <input
              type="text"
              id="tipo"
              v-model="form.tipo"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              required
            />
            <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
          </div>

          <div class="mb-4">
            <label for="raza" class="block text-sm font-semibold text-gray-700">Raza</label>
            <input
              type="text"
              id="raza"
              v-model="form.raza"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              required
            />
            <div v-if="form.errors.raza" class="text-red-500 text-sm mt-1">{{ form.errors.raza }}</div>
          </div>

          <div class="mb-4">
            <label for="sexo" class="block text-sm font-semibold text-gray-700">Sexo</label>
            <select
              v-model="form.sexo"
              id="sexo"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            >
              <option value="Macho">Macho</option>
              <option value="Hembra">Hembra</option>
            </select>
            <div v-if="form.errors.sexo" class="text-red-500 text-sm mt-1">{{ form.errors.sexo }}</div>
          </div>

          <div class="mb-4">
            <label for="fechaNacimiento" class="block text-sm font-semibold text-gray-700">Fecha de Nacimiento</label>
            <input
              type="date"
              id="fechaNacimiento"
              v-model="form.fechaNacimiento"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              required
            />
            <div v-if="form.errors.fechaNacimiento" class="text-red-500 text-sm mt-1">{{ form.errors.fechaNacimiento }}</div>
          </div>

          <div class="mb-4">
            <label for="user_id" class="block text-sm font-semibold text-gray-700">Cliente</label>
            <input
              type="text"
              :value="userName"
              id="user_id"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              disabled
            />
            <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">{{ form.errors.user_id }}</div>
          </div>

          <div class="mb-4">
            <label for="imagen" class="block text-sm font-semibold text-gray-700">Imagen (opcional)</label>
            <input
              type="file"
              id="imagen"
              @change="handleFileChange"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
              accept="image/*"
            />
            <div v-if="form.errors.imagen" class="text-red-500 text-sm mt-1">{{ form.errors.imagen }}</div>
          </div>

          <div class="mb-4">
            <label for="observaciones" class="block text-sm font-semibold text-gray-700">Observaciones</label>
            <textarea
              id="observaciones"
              v-model="form.observaciones"
              class="mt-2 p-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            ></textarea>
            <div v-if="form.errors.observaciones" class="text-red-500 text-sm mt-1">{{ form.errors.observaciones }}</div>
          </div>

          <div class="flex justify-center gap-4">
            <button
              type="submit"
              class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"
            >
              Registrar Animal
            </button>
            <a :href="route('animales.index')" class="w-full bg-gray-300 text-gray-800 text-center py-2 px-4 rounded-md hover:bg-gray-400">
              Volver
            </a>
          </div>
        </form>
      </div>
    </div>

    <FooterWorkers />
  </AppLayout>
</template>
