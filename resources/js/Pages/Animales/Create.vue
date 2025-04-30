<script setup>
import NavBar from '@/Components/NavBar.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    users: Array,
});

// Usamos FormData para manejar la subida de archivos
const form = useForm({
    nombre: '',
    tipo: '',
    raza: '',
    sexo: '',
    fechaNacimiento: '',
    user_id: '',
    imagen: null,  // Inicializamos el campo de imagen como null
    observaciones: '',
});

const handleFileChange = (event) => {
    const file = event.target.files[0];  // Obtenemos el archivo
    if (file) {
        form.imagen = file;  // Asignamos el archivo al campo imagen
    }
};

const submit = () => {
    const data = new FormData();

    // Añadimos los datos del formulario
    data.append('nombre', form.nombre);
    data.append('tipo', form.tipo);
    data.append('raza', form.raza);
    data.append('sexo', form.sexo);
    data.append('fechaNacimiento', form.fechaNacimiento);
    data.append('user_id', form.user_id);
    data.append('observaciones', form.observaciones);

    // Si hay una imagen, la añadimos también
    if (form.imagen) {
    data.append('imagen', form.imagen);
}

    // Enviamos los datos utilizando POST y FormData
    form.post(route('animales.store'), {
        data,  // Pasamos los datos con FormData
        forceFormData: true, // Habilitamos el uso de FormData
        onSuccess: () => {
            alert("¡Animal registrado correctamente!");
        },
        onError: (errors) => {
            console.log(errors);
        }
    });
};
</script>


<template>
    <AppLayout title="Panel de animales">
        <template #header>
            <NavBar/>
        </template>

        <div class="container mx-auto my-12">
            <div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-lg">
                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Registrar Nuevo Animal</h2>

                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-medium">Nombre</label>
                        <input v-model="form.nombre" type="text" id="nombre" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                        <div v-if="form.errors.nombre" class="text-red-500 text-sm mt-1">{{ form.errors.nombre }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-gray-700 font-medium">Tipo</label>
                        <input v-model="form.tipo" type="text" id="tipo" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                        <div v-if="form.errors.tipo" class="text-red-500 text-sm mt-1">{{ form.errors.tipo }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="raza" class="block text-gray-700 font-medium">Raza</label>
                        <input v-model="form.raza" type="text" id="raza" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                        <div v-if="form.errors.raza" class="text-red-500 text-sm mt-1">{{ form.errors.raza }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="sexo" class="block text-gray-700 font-medium">Sexo</label>
                        <select v-model="form.sexo" id="sexo" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                        <div v-if="form.errors.sexo" class="text-red-500 text-sm mt-1">{{ form.errors.sexo }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="fechaNacimiento" class="block text-gray-700 font-medium">Fecha de Nacimiento</label>
                        <input v-model="form.fechaNacimiento" type="date" id="fechaNacimiento" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                        <div v-if="form.errors.fechaNacimiento" class="text-red-500 text-sm mt-1">{{ form.errors.fechaNacimiento }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 font-medium">Cliente</label>
                        <select v-model="form.user_id" id="user_id" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required>
                            <option v-for="user in props.users" :key="user.id" :value="user.id">
                                {{ user.name }} {{ user.apellidos }}
                            </option>
                        </select>
                        <div v-if="form.errors.user_id" class="text-red-500 text-sm mt-1">{{ form.errors.user_id }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="imagen" class="block text-gray-700 font-medium">Imagen</label>
                        <input id="imagen" name="imagen" type="file"
                               class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"
                               @change="handleFileChange" />
                        <div v-if="form.errors.imagen" class="text-red-500 text-sm mt-1">{{ form.errors.imagen }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="observaciones" class="block text-gray-700 font-medium">Observaciones</label>
                        <textarea v-model="form.observaciones" id="observaciones" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
                        <div v-if="form.errors.observaciones" class="text-red-500 text-sm mt-1">{{ form.errors.observaciones }}</div>
                    </div>

                    <div class="flex justify-center gap-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Registrar Animal</button>
                        <a :href="route('animales.index')" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>
