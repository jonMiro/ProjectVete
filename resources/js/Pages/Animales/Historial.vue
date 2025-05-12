
    <template>
  <AppLayout title="Historial">
    <template #header>
        <NavBar />
    </template>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Historial de {{ animal.nombre }}</h1>

        <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Consultas</h2>
           <ul v-if="consultas.length" class="list-disc pl-6 space-y-1">
    <li v-for="consulta in consultas" :key="consulta.id">
        <Link
            :href="route('consultas.show', consulta.id)"
            class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200 inline-block"
        >
            {{ consulta.fecha }} - {{ consulta.motivo }} ({{ consulta.user?.name || 'Sin veterinario' }})
        </Link>
    </li>
</ul>

            <p v-else class="text-gray-500">No hay consultas registradas.</p>
        </section>

        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Servicios</h2>
            <ul v-if="servicios.length" class="list-disc pl-6 space-y-1">
                <li v-for="servicio in servicios" :key="servicio.id">
                    <Link
            :href="route('servicios.show', servicio.id)"
            class="bg-blue-100 text-blue-800 text-sm py-1 px-2 rounded-lg hover:bg-blue-200 inline-block"
        >
                    {{ servicio.fecha }} - {{ servicio.tipo_servicio }} ({{ servicio.user?.name || 'Sin responsable' }})
                     </Link>
                </li>
            </ul>
            <p v-else class="text-gray-500">No hay servicios registrados.</p>
        </section>


    </div>
<FooterWorkers />
  </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
import NavBar from '@/Components/NavBar.vue';
import { Link } from '@inertiajs/vue3';


defineProps({
    animal: Object,
    consultas: Array,
    servicios: Array,
});
</script>
