<template>
    <AppLayout title="Editar Animal">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         Editar Animal
        </h2>        </template>

        <div class="container mx-auto my-12">
            <div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-lg">


                <form @submit.prevent="submit">
                    <div class="mb-4">
                        <label for="nombre" class="block text-gray-700 font-medium">Nombre</label>
                        <input v-model="form.nombre" type="text" id="nombre" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-gray-700 font-medium">Tipo</label>
                        <input v-model="form.tipo" type="text" id="tipo" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
                    </div>

                    <div class="mb-4">
                        <label for="raza" class="block text-gray-700 font-medium">Raza</label>
                        <input v-model="form.raza" type="text" id="raza" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500" required />
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


                    <label for="cliente" class="block text-gray-700 font-medium">Cliente</label>
<input
    type="text"
    id="cliente"
    :value="`${props.user.name} ${props.user.apellidos}`"
    class="w-full px-4 py-2 border rounded-md bg-gray-100 cursor-not-allowed"
    disabled
/>


                    <div class="mb-4">
                        <label for="observaciones" class="block text-gray-700 font-medium">Observaciones</label>
                        <textarea v-model="form.observaciones" id="observaciones" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="flex justify-center gap-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Actualizar Animal</button>
                        <a :href="route('clients.animales.index')" class="px-6 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none">Volver</a>
                    </div>
                </form>
            </div>
        </div>
        <FooterWorkers />
    </AppLayout>
</template>

<script setup>
import NavBar from '@/Components/NavBar.vue';
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';


const props = defineProps({
    user: Object,
    animal: Object, 
});

const form = useForm({
    nombre: props.animal.nombre || '',
    tipo: props.animal.tipo || '',
    raza: props.animal.raza || '',
    sexo: props.animal.sexo || '',
    fechaNacimiento: props.animal.fechaNacimiento || '',
    user_id: props.animal.user_id || '',
    imagen: null,
    observaciones: props.animal.observaciones || '',
});

const submit = () => {
    form.put(route('clients.animales.update', props.animal.id), {
        onSuccess: () => {
            alert("¡Animal actualizado correctamente!");
        },
        onError: (errors) => {
            console.log(errors);
        }
    });
};
</script>
