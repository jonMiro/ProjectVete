<template>
    <form @submit.prevent="submitForm" class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Nombre -->
        <div class="relative z-0 w-full group">
          <input v-model="form.name" type="text" id="name" name="name" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="name" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Nombre</label>
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>

        <!-- Apellidos -->
        <div class="relative z-0 w-full group">
          <input v-model="form.apellidos" type="text" id="apellidos" name="apellidos" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
          <label for="apellidos" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Apellidos</label>
          <div v-if="form.errors.apellidos" class="text-red-500 text-sm mt-1">{{ form.errors.apellidos }}</div>
        </div>

        <!-- Correo Electrónico -->
        <div class="relative z-0 w-full group">
          <input v-model="form.email" type="email" id="email" name="email" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="email" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Correo</label>
          <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
        </div>

        <!-- Teléfono -->
        <div class="relative z-0 w-full group">
          <input v-model="form.telefono" type="text" id="telefono" name="telefono" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
          <label for="telefono" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Teléfono</label>
          <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">{{ form.errors.telefono }}</div>
        </div>

        <!-- Dirección -->
        <div class="relative z-0 w-full group">
          <input v-model="form.direccion" type="text" id="direccion" name="direccion" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
          <label for="direccion" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Dirección</label>
          <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">{{ form.errors.direccion }}</div>
        </div>

        <!-- Tipo de Usuario -->
<div class="relative z-0 w-full group">
  <label for="tipo" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600 flex justify-center w-full">Tipo de Usuario</label>
  <select v-model="form.tipo" id="tipo" name="tipo" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
    <option value="cliente">Cliente</option>
    <option value="veterinario">Veterinario</option>
    <option value="auxiliar">Auxiliar</option>
  </select>
  <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
</div>


        <!-- Es Trabajador -->
<div class="relative z-0 w-full group">
  <label class="flex items-center space-x-2 text-gray-700 font-medium mt-4 ml-4"> <!-- Movido hacia la derecha con ml-4 y bajado con mt-4 -->
    <input type="checkbox" v-model="form.is_worker" id="is_worker" name="is_worker" class="peer" />
    <span>¿Es trabajador?</span>
  </label>
  <div v-if="form.errors.is_worker" class="text-red-500 text-sm mt-1">{{ form.errors.is_worker }}</div>
</div>


        <!-- Contraseña -->
        <div class="relative z-0 w-full group">
          <input v-model="form.password" type="password" id="password" name="password" class="block py-2.5 pl-3 w-full text-lg text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
          <label for="password" class="peer-focus:font-medium absolute text-lg text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-blue-600">Contraseña</label>
          <div v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}</div>
        </div>
      </div>

      <!-- Mensaje Contraseña Predeterminada -->
      <div class="text-gray-500 mt-2 text-lg">
        Tu contraseña predeterminada es: <strong>12345678</strong>. ¡Recuerda cambiarla cuando puedas!
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-4">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none text-lg">
          Crear Usuario
        </button>
        <a :href="route('users.index')" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none text-lg">Volver</a>
      </div>
    </form>
  </template>

  <script setup>
  import { ref } from 'vue';
  import { Inertia } from '@inertiajs/inertia';

  const form = ref({
    name: '',
    apellidos: '',
    email: '',
    telefono: '',
    direccion: '',
    tipo: 'cliente',
    is_worker: false,
    password: '12345678',
    errors: {}
  });

  const submitForm = () => {
    Inertia.post(route('alta.storeUser'), form.value, {
      onSuccess: () => {
        console.log('Usuario creado con éxito');
      },
      onError: () => {
        console.log('Hubo un error');
      }
    });
  };
  </script>
