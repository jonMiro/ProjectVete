<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import NavBar from '@/Components/NavBar.vue';



const props = defineProps({
  servicio: Object,
  users: Array,
  animales: Array,
});

const form = useForm({
  user_id: props.servicio?.user_id || null,
  animal_id: props.servicio?.animal_id || null,
  tipo_servicio: props.servicio?.tipo_servicio || '',
  descripcion: props.servicio?.descripcion || '',
  duracion: props.servicio?.duracion || 0,
  precio: props.servicio?.precio || 0,
  fecha: props.servicio?.fecha || '',
  hora: props.servicio.hora,
});

// submit form
const submit = () => {
  form.put(route('servicios.update', props.servicio.id), {
    onSuccess: () => {
      form.reset();
    },
  });
};
</script>

<template>
  <AppLayout title="Editar Servicio">
    <template #header>
    <NavBar />
    </template>

    <div class="max-w-4xl mx-auto px-6 py-10 mt-8 bg-white rounded-lg shadow">
      <h2 class="text-2xl font-bold text-center mb-8">Editar Servicio</h2>

      <form @submit.prevent="submit" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Auxiliar -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Auxiliar</label>
          <select v-if="props.users && props.users.length" v-model="form.user_id" class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800">
            <option v-for="user in props.users" :key="user.id" :value="user.id">
              {{ user.name }} {{ user.apellidos }}
            </option>
          </select>
        </div>

        <!-- Animal -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Animal</label>
          <select v-if="props.animales && props.animales.length" v-model="form.animal_id" class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800">
            <option v-for="animal in props.animales" :key="animal.id" :value="animal.id">
              {{ animal.nombre }}
            </option>
          </select>
        </div>

        <!-- Tipo de Servicio -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Tipo de Servicio</label>
          <input
            v-model="form.tipo_servicio"
            type="text"
            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800"
            required
          />
        </div>

        <!-- Descripción -->
        <div class="md:col-span-2">
          <label class="block mb-1 text-sm font-medium text-gray-700">Descripción</label>
          <textarea
            v-model="form.descripcion"
            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800"
            rows="2"
          ></textarea>
        </div>

        <!-- Duración -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Duración (minutos)</label>
          <input
            v-model="form.duracion"
            type="number"
            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800"
            required
          />
        </div>

        <!-- Precio -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Precio (€)</label>
          <input
            v-model="form.precio"
            type="number"
            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800"
            required
          />
        </div>

        <!-- Fecha -->
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Fecha</label>
          <input
            v-model="form.fecha"
            type="date"
            class="w-full border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800"
            required
          />
        </div>

        <div class="mt-4">
  <label class="block text-sm font-medium text-gray-700">Hora :</label>
  <p class="border-b-2 border-gray-300 px-3 py-2 focus:border-blue-600 focus:outline-none text-gray-800">{{ form.hora }}</p>
</div>

        <!-- Botón -->
        <div class="md:col-span-2 text-center mt-4">
          <button
            type="submit"
            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600"
          >
            Actualizar Servicio
          </button>
        </div>

        <!-- cancelar -->
        <div class="md:col-span-2 text-center mt-4">
          <Link :href="route('servicios.index')" class="text-blue-500">Cancelar</Link>
        </div>
      </form>
    </div>
    <FooterWorkers />
  </AppLayout>
</template>
