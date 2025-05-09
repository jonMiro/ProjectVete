<script setup>
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import FooterWorkers from '@/Components/FooterWorkers.vue';

const props = defineProps({
    user: Object
});

const form = useForm({
    name: props.user.name || '',
    apellidos: props.user.apellidos || '',
    email: props.user.email || '',
    telefono: props.user.telefono || '',
    direccion: props.user.direccion || '',
    tipo: props.user.tipo || 'cliente',
    is_worker: !!props.user.is_worker,}); // !!convertir 1,0 que es el valor a boolean false:true

const submit = () => {
    form.put(route('users.update', props.user.id), {
        onSuccess: () => alert("¡Usuario actualizado correctamente!"),
        onError: (errors) => console.log(errors),
    });
};
</script>

<template>
    <AppLayout title="Editar Usuario">
        <template #header>
            <NavBar />
        </template>

        <div class="container mx-auto my-12 px-4">
            <div class="max-w-2xl mx-auto bg-white p-8 shadow-xl rounded-2xl">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Editar Usuario</h2>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Campo nombre -->
                    <div class="space-y-1">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input v-model="form.name" type="text" id="name" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-600 focus:ring focus:ring-blue-200 outline-none text-gray-800" />
                        <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                    </div>

                    <!-- Apellidos -->
                    <div class="space-y-1">
                        <label for="apellidos" class="block text-sm font-medium text-gray-700">Apellidos:</label>
                        <input v-model="form.apellidos" type="text" id="apellidos"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-600 focus:ring focus:ring-blue-200 outline-none text-gray-800" />
                        <div v-if="form.errors.apellidos" class="text-red-500 text-sm mt-1">{{ form.errors.apellidos }}</div>
                    </div>

                    <!-- Email -->
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico:</label>
                        <input v-model="form.email" type="email" id="email" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-600 focus:ring focus:ring-blue-200 outline-none text-gray-800" />
                        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                    </div>

                    <!-- Teléfono -->
                    <div class="space-y-1">
                        <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                        <input v-model="form.telefono" type="text" id="telefono"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-600 focus:ring focus:ring-blue-200 outline-none text-gray-800" />
                        <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">{{ form.errors.telefono }}</div>
                    </div>

                    <!-- Dirección -->
                    <div class="space-y-1">
                        <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección:</label>
                        <input v-model="form.direccion" type="text" id="direccion"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-600 focus:ring focus:ring-blue-200 outline-none text-gray-800" />
                        <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">{{ form.errors.direccion }}</div>
                    </div>

                    <!-- Tipo -->
                    <div class="space-y-1">
                        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo de usuario:</label>
                        <select v-model="form.tipo" id="tipo"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:border-blue-600 focus:ring focus:ring-blue-200 outline-none text-gray-800 bg-white">
                            <option value="cliente">Cliente</option>
                            <option value="veterinario">Veterinario</option>
                            <option value="auxiliar">Auxiliar</option>
                        </select>
                        <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
                    </div>

                    <!-- Checkbox trabajador -->
                    <div class="flex items-center gap-2 mt-4">
                        <input type="checkbox" v-model="form.is_worker" id="is_worker"
                            class="accent-blue-600 w-5 h-5" />
                        <label for="is_worker" class="text-gray-700 font-medium text-sm">¿Es trabajador?</label>
                    </div>
                    <div v-if="form.errors.is_worker" class="text-red-500 text-sm mt-1">{{ form.errors.is_worker }}</div>

                    <!-- Botones -->
                    <div class="flex justify-center gap-4 pt-6">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-200">
                            Actualizar Usuario
                        </button>
                        <a :href="route('users.index')"
                            class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition duration-200">
                            Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <FooterWorkers />
    </AppLayout>
</template>
