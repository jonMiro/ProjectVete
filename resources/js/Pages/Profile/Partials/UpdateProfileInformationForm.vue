<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    name: props.user.name || '',
    apellidos: props.user.apellidos || '',
    email: props.user.email || '',
    telefono: props.user.telefono || '',
    direccion: props.user.direccion || '',
});

const submit = () => {
    form.put(route('users.update', props.user.id), {
        onSuccess: () => alert("¡Usuario actualizado correctamente!"),
        onError: (errors) => console.log(errors),
    });
};
</script>
<template>
    <div class="container mx-auto px-4">
      <!-- Contenedor principal con dos columnas: descripción y formulario -->
      <div class="flex flex-col md:flex-row gap-8">

        <!-- Descripción a la izquierda -->
        <div class="flex-1 w-full md:max-w-[60%]">
          <h2 class="text-lg font-medium text-gray-900 mb-2">Editar Usuario</h2>
          <p class="text-sm text-gray-600 mb-4">
            Actualiza la información del usuario con los siguientes campos: nombre, apellidos, correo electrónico, teléfono, dirección y tipo de usuario.
          </p>
        </div>

        <!-- Formulario a la derecha -->
        <div class="flex-1 bg-white p-8 shadow-lg rounded-lg">
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

              <!-- Nombre -->
              <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium">Nombre</label>
                <input v-model="form.name" type="text" id="name" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
              </div>

              <!-- Apellidos -->
              <div class="mb-4">
                <label for="apellidos" class="block text-gray-700 font-medium">Apellidos</label>
                <input v-model="form.apellidos" type="text" id="apellidos" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
                <div v-if="form.errors.apellidos" class="text-red-500 text-sm mt-1">{{ form.errors.apellidos }}</div>
              </div>

              <!-- Correo electrónico -->
              <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Correo electrónico</label>
                <input v-model="form.email" type="email" id="email" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
              </div>

              <!-- Teléfono -->
              <div class="mb-4">
                <label for="telefono" class="block text-gray-700 font-medium">Teléfono</label>
                <input v-model="form.telefono" type="text" id="telefono" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
                <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">{{ form.errors.telefono }}</div>
              </div>

              <!-- Dirección -->
              <div class="mb-4">
                <label for="direccion" class="block text-gray-700 font-medium">Dirección</label>
                <input v-model="form.direccion" type="text" id="direccion" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
                <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">{{ form.errors.direccion }}</div>
              </div>

            </div>

            <div class="flex justify-center gap-4 mt-6">
              <button type="submit" class="px-6 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 focus:outline-none w-full md:w-auto">Actualizar Usuario</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</template>
