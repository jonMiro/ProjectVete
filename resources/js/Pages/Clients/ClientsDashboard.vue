<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBarClients from '@/Components/NavBarClients.vue';
import { Link } from '@inertiajs/vue3';
import Footer from '@/Components/Footer.vue'
</script>

<template>
    <AppLayout title="Panel de Usuarios">
        <template #header>
        </template>

        <div class="p-6 text-gray-700">
            <!-- Contenedor de las secciones -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Sección 1: Mi perfil-->
                <Link href="user/profile" class="block">

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full">
                    <img src="/icons/profile.png" alt="Logo Perfil" class="w-16 h-16 mb-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">Mi perfil</h3>
                        <p class="text-gray-600">Gestiona tu información personal y preferencias.</p>
                    </div>
                </div>
            </Link>

      <!-- Sección 2: Administrar mascotas -->
<Link :href="route('clients.animales.index')" class="block">
    <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full cursor-pointer hover:shadow-lg transition-shadow">
        <img src="/icons/pet.png" alt="Logo Mascota" class="w-16 h-16 mb-4">
        <div class="text-center">
            <h3 class="text-xl font-semibold">Administrar mascotas</h3>
            <p class="text-gray-600">Añade, edita o elimina información de tus mascotas.</p>
        </div>
    </div>
</Link>


                <!-- Sección 3: Comunidad -->
                <Link :href="route('posts.index')" class="block">
                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full">
                    <img src="/icons/social.png" alt="Logo Comunidad" class="w-16 h-16 mb-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">Comunidad</h3>
                        <p class="text-gray-600">Conéctate con otros usuarios de la plataforma.</p>
                    </div>
                </div>
            </Link>
                <!-- Sección 4: Servicios -->
                <Link href="clients/eventos/create" class="block">
    <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full cursor-pointer hover:shadow-lg transition-shadow">
        <img src="/icons/social.png" alt="Logo Servicios" class="w-16 h-16 mb-4">
        <div class="text-center">
            <h3 class="text-xl font-semibold">Servicios</h3>
            <p class="text-gray-600">Explora los servicios que ofrecemos para ti y tus mascotas.</p>
        </div>
    </div>
    </Link>


                <!-- Sección 5: Consulta -->
                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full">
                    <img src="/icons/consultas.png" alt="Logo Consulta" class="w-16 h-16 mb-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">Consulta</h3>
                        <p class="text-gray-600">Realiza consultas sobre tu cuenta y servicios.</p>
                    </div>
                </div>

                <!-- Sección 6: Tienda -->
                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full">
                    <img src="/icons/tiendas.png" alt="Logo Tienda" class="w-16 h-16 mb-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">Tienda</h3>
                        <p class="text-gray-600">Compra productos para ti y tus mascotas.</p>
                    </div>
                </div>

            </div>
        </div>
        <Footer />
    </AppLayout>
</template>
