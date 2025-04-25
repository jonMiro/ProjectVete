<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBar from '@/Components/NavBar.vue';

import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import axios from 'axios';

const events = ref([]);

onMounted(async () => {
    events.value = [
        {
            title: 'Consulta - Firulais',
            start: '2025-04-25T10:00:00',
            end: '2025-04-25T11:00:00',
        },
        {
            title: 'Servicio - Vacunación',
            start: '2025-04-26T14:00:00',
        },
    ];
});
</script>

<template>
    <AppLayout title="Panel de Trabajadores">
        <template #header>
            <NavBar />
        </template>

        <div class="p-6 text-gray-700">
            <h2 class="text-2xl mb-4">Calendario de Consultas y Servicios</h2>

            <FullCalendar
                :plugins="[dayGridPlugin, timeGridPlugin, interactionPlugin]"
                :events="events"
                :initialView="'dayGridMonth'"
                :headerToolbar="{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }"
                height="600px"
            />
        </div>
    </AppLayout>
</template>

<style scoped>
/* Agrega personalización si querés */
</style>
