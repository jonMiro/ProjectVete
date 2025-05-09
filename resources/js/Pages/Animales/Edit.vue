<script setup>
import NavBar from '@/Components/NavBar.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    users: Array,
    animal: Object,
});

const form = useForm({
    nombre: props.animal.nombre || '',
    tipo: props.animal.tipo || '',
    raza: props.animal.raza || '',
    sexo: props.animal.sexo || '',
    fechaNacimiento: props.animal.fechaNacimiento || '',
    user_id: props.animal.user_id || '',
    observaciones: props.animal.observaciones || '',
});

const submit = () => {
    if (form.imagen) {
        const formData = new FormData();
        formData.append('nombre', form.nombre);
        formData.append('tipo', form.tipo);
        formData.append('raza', form.raza);
        formData.append('sexo', form.sexo);
        formData.append('fechaNacimiento', form.fechaNacimiento);
        formData.append('imagen', form.imagen);
        formData.append('observaciones', form.observaciones);

        form.put(route('animales.update', props.animal.id), formData, {
            onSuccess: () => {
                alert("¡Animal actualizado correctamente!");
            },
            onError: (errors) => {
                console.log(errors);
            }
        });
    } else {
        form.put(route('animales.update', props.animal.id), {
            nombre: form.nombre,
            tipo: form.tipo,
            raza: form.raza,
            sexo: form.sexo,
            fechaNacimiento: form.fechaNacimiento,
            observaciones: form.observaciones,
        });
    }
};
const getUserName = (userId) => {
    const user = props.users.find(u => u.id === userId);
    return user ? `${user.name} ${user.apellidos}` : 'Usuario no encontrado';
};

</script>

<template>
    <AppLayout title="Editar Animal">
        <template #header>
            <NavBar />
        </template>

        <div class="container mx-auto my-12 px-4">
            <div class="max-w-2xl mx-auto bg-white p-8 shadow-xl rounded-2xl">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Editar Animal</h2>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Nombre -->
                    <div class="space-y-1">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input v-model="form.nombre" type="text" id="nombre" required
                            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
                        <div v-if="form.errors.nombre" class="text-red-500 text-sm mt-1">{{ form.errors.nombre }}</div>
                    </div>

                    <!-- Tipo -->
                    <div class="space-y-1">
                        <label for="tipo" class="block text-sm font-medium text-gray-700">Tipo:</label>
                        <input v-model="form.tipo" type="text" id="tipo" required
                            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
                        <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
                    </div>

                    <!-- Raza -->
                    <div class="space-y-1">
                        <label for="raza" class="block text-sm font-medium text-gray-700">Raza:</label>
                        <input v-model="form.raza" type="text" id="raza" required
                            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
                        <div v-if="form.errors.raza" class="text-red-500 text-sm mt-1">{{ form.errors.raza }}</div>
                    </div>

                    <!-- Sexo -->
                    <div class="space-y-1">
                        <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
                        <select v-model="form.sexo" id="sexo"
                            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800 bg-white">
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                        <div v-if="form.errors.sexo" class="text-red-500 text-sm mt-1">{{ form.errors.sexo }}</div>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div class="space-y-1">
                        <label for="fechaNacimiento" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento:</label>
                        <input v-model="form.fechaNacimiento" type="date" id="fechaNacimiento" required
                            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800" />
                        <div v-if="form.errors.fechaNacimiento" class="text-red-500 text-sm mt-1">{{ form.errors.fechaNacimiento }}</div>
                    </div>

                    <!-- Observaciones -->
                    <div class="space-y-1">
                        <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones:</label>
                        <textarea v-model="form.observaciones" id="observaciones"
                            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800"></textarea>
                        <div v-if="form.errors.observaciones" class="text-red-500 text-sm mt-1">{{ form.errors.observaciones }}</div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-center gap-4 pt-6">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-200">
                            Actualizar Animal
                        </button>
                        <a :href="route('animales.index')"
                            class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition duration-200">
                            Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
