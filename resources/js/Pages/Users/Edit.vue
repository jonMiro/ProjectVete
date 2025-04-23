<script setup>
import NavBar from '@/Components/NavBar.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

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
    is_worker: props.user.is_worker || false,
});

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

        <div class="container mx-auto my-12">
            <div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Editar Usuario</h2>

                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium">Nombre</label>
                        <input v-model="form.name" type="text" id="name" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                        <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="apellidos" class="block text-gray-700 font-medium">Apellidos</label>
                        <input v-model="form.apellidos" type="text" id="apellidos" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
                        <div v-if="form.errors.apellidos" class="text-red-500 text-sm mt-1">{{ form.errors.apellidos }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium">Correo electrónico</label>
                        <input v-model="form.email" type="email" id="email" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                        <div v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="block text-gray-700 font-medium">Teléfono</label>
                        <input v-model="form.telefono" type="text" id="telefono" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
                        <div v-if="form.errors.telefono" class="text-red-500 text-sm mt-1">{{ form.errors.telefono }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="block text-gray-700 font-medium">Dirección</label>
                        <input v-model="form.direccion" type="text" id="direccion" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" />
                        <div v-if="form.errors.direccion" class="text-red-500 text-sm mt-1">{{ form.errors.direccion }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-gray-700 font-medium">Tipo de Usuario</label>
                        <select v-model="form.tipo" id="tipo" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="cliente">Cliente</option>
                            <option value="veterinario">Veterinario</option>
                            <option value="auxiliar">Auxiliar</option>
                        </select>
                        <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
                    </div>

                    <div class="mb-4">
                        <label class="flex items-center space-x-2 text-gray-700 font-medium">
                            <input type="checkbox" v-model="form.is_worker" />
                            <span>¿Es trabajador?</span>
                        </label>
                        <div v-if="form.errors.is_worker" class="text-red-500 text-sm mt-1">{{ form.errors.is_worker }}</div>
                    </div>

                    <div class="flex justify-center gap-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Actualizar Usuario</button>
                        <a :href="route('users.index')" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
