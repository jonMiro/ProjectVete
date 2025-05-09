<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    clientes: Array,
});

// FormData
const form = useForm({
    nombre: '',
    tipo: '',
    raza: '',
    sexo: '',
    fechaNacimiento: '',
    user_id: '',
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

    // Afegim les dades al form
    data.append('nombre', form.nombre);
    data.append('tipo', form.tipo);
    data.append('raza', form.raza);
    data.append('sexo', form.sexo);
    data.append('fechaNacimiento', form.fechaNacimiento);
    data.append('user_id', form.user_id);
    data.append('observaciones', form.observaciones);

    // image
    if (form.imagen) {
        data.append('imagen', form.imagen);
    }

    form.post(route('animales.store'), {
        data,
        forceFormData: true, // per a la imatge
        onSuccess: () => {
            alert("¡Animal registrado correctamente!");
        },
        onError: (errors) => {
            console.log(errors);
        }
    });
};

const autoResize = (event) => {
  const textarea = event.target;
  textarea.style.height = "auto"; // Reset
  textarea.style.height = textarea.scrollHeight + "px"; // Ajuste dinámico
};

</script>
<template>
    <form @submit.prevent="submit" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nombre -->
        <div class="relative z-0 w-full group">
          <input v-model="form.nombre" type="text" id="nombre" name="nombre"
            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
            placeholder=" " required />
          <label for="nombre"
            class="absolute top-3 left-0 z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:text-blue-600">Nombre</label>
          <div v-if="form.errors.nombre" class="text-red-500 text-sm mt-1">{{ form.errors.nombre }}</div>
        </div>

        <!-- Tipo -->
        <div class="relative z-0 w-full group">
          <input v-model="form.tipo" type="text" id="tipo" name="tipo"
            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
            placeholder=" " required />
          <label for="tipo"
            class="absolute top-3 left-0 z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:text-blue-600">Tipo</label>
          <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
        </div>

        <!-- Raza -->
        <div class="relative z-0 w-full group">
          <input v-model="form.raza" type="text" id="raza" name="raza"
            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
            placeholder=" " required />
          <label for="raza"
            class="absolute top-3 left-0 z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:text-blue-600">Raza</label>
          <div v-if="form.errors.raza" class="text-red-500 text-sm mt-1">{{ form.errors.raza }}</div>
        </div>

        <!-- Sexo -->
        <div class="relative z-0 w-full group">
          <select v-model="form.sexo" id="sexo" name="sexo"
            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0">
            <option disabled value="">Selecciona el sexo</option>
            <option value="Macho">Macho</option>
            <option value="Hembra">Hembra</option>
          </select>
          <label for="sexo"
            class="absolute top-3 left-0 z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-focus:text-blue-600">Sexo</label>
          <div v-if="form.errors.sexo" class="text-red-500 text-sm mt-1">{{ form.errors.sexo }}</div>
        </div>

        <!-- Fecha de Nacimiento -->
        <div class="relative z-0 w-full group">
          <input v-model="form.fechaNacimiento" type="date" id="fechaNacimiento" name="fechaNacimiento"
            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
            placeholder=" " />
          <label for="fechaNacimiento"
            class="absolute top-3 left-0 z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:text-blue-600">Fecha de nacimiento</label>
          <div v-if="form.errors.fechaNacimiento" class="text-red-500 text-sm mt-1">{{ form.errors.fechaNacimiento }}</div>
        </div>

        <!-- Cliente -->
        <div class="relative z-0 w-full group">
          <select v-model="form.user_id" id="user_id" name="user_id"
            class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-2.5 text-lg text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0">
            <option disabled value="">Selecciona un cliente</option>
            <option v-for="cliente in props.clientes" :key="cliente.id" :value="cliente.id">
              {{ cliente.name }} {{ cliente.apellidos }}
            </option>
          </select>
          <label for="user_id"
            class="absolute top-3 left-0 z-10 origin-[0] -translate-y-6 scale-75 transform text-lg text-gray-500 duration-300 peer-focus:text-blue-600">Propietario</label>
          <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">{{ form.errors.user_id }}</div>
        </div>

       <!-- Observaciones -->
<div class="relative z-0 w-full group md:col-span-2">
  <textarea
    v-model="form.observaciones"
    id="observaciones"
    name="observaciones"
    rows="1"
    @input="autoResize($event)"
    class="block overflow-hidden resize-none py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
    placeholder=" "
  ></textarea>
  <label
    for="observaciones"
    class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600"
  >
    Observaciones
  </label>
  <div v-if="form.errors.observaciones" class="text-red-500 text-sm mt-1">
    {{ form.errors.observaciones }}
  </div>
</div>


        <!-- Imagen -->
        <div class="relative z-0 w-full group md:col-span-2">
          <label for="imagen" class="block text-sm text-gray-700 mb-1">Imagen (opcional)</label>
          <input @change="handleFileChange" type="file" id="imagen" name="imagen" accept="image/*"
            class="block w-full text-sm text-gray-700 bg-white border border-gray-300 rounded-md cursor-pointer focus:outline-none file:border-0 file:bg-gray-100 file:text-gray-700 file:px-3 file:py-1.5 file:rounded-md hover:file:bg-gray-200" />
          <div v-if="form.errors.imagen" class="text-red-500 text-sm mt-1">{{ form.errors.imagen }}</div>
        </div>
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-4">
        <button type="submit"
          class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none text-lg">
          Registrar Animal
        </button>
        <a :href="route('animales.index')"
          class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none text-lg">Volver</a>
      </div>
    </form>
  </template>

