<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import NavBar from '@/Components/NavBar.vue'
import Calendario from '@/Components/Calendario.vue'
import Footer from '@/Components/Footer.vue'
import AgendaDiaria from '@/Components/AgendaDiaria.vue'
</script>

<template>
    <AppLayout title="Panel de Trabajadores">
        <template #header>
            <NavBar />
        </template>

        <div class="dashboard-container">
            <!-- Agenda diaria -->
            <div class="agenda-section">
             <AgendaDiaria />
            </div>


            <!-- Calendario -->
            <div class="calendar-section">
                <Calendario />
            </div>
        </div>
        <Footer />
    </AppLayout>
</template>

<style scoped>
.dashboard-container {
  display: flex;
  flex-direction: row;
  padding: 20px;
}

.agenda-section {
  flex: 1;
  padding: 20px;
  border-right: 1px solid #e2e8f0;
}

.calendar-section {
  flex: 1;
  margin: 20px;
  padding: 10px;
  border: 1px solid #cbd5e0;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  background-color: white;
}
</style>
