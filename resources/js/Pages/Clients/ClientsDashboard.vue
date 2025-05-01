<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

  const menuOpen = ref(false)

  function toggleMenu() {
    menuOpen.value = !menuOpen.value
  }

  onMounted(() => {
    document.addEventListener('click', (e) => {
      if (!e.target.closest('footer')) {
        menuOpen.value = false
      }
    })
  })

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
                <Link :href="route('clients.historial.index')" class="block">

                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full">
                    <img src="/icons/consultas.png" alt="Logo Consulta" class="w-16 h-16 mb-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">Consulta</h3>
                        <p class="text-gray-600">Realiza consultas sobre tu cuenta y servicios.</p>
                    </div>
                </div>
            </Link>

                <!-- Sección 6: Tienda -->
                <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md h-full">
                    <img src="/icons/tiendas.png" alt="Logo Tienda" class="w-16 h-16 mb-4">
                    <div class="text-center">
                        <h3 class="text-xl font-semibold">Tienda (pronto...)</h3>
                        <p class="text-gray-600">Compra productos para ti y tus mascotas.</p>
                    </div>
                </div>

            </div>
        </div>
        <footer class="bg-gray-800 text-white py-2 mt-10">
      <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center text-xs relative w-full">
        <!-- Logo + text-->
        <div class="flex items-center space-x-2 mb-2 sm:mb-0">
          <Link :href="route('dashboard')">
            <img src="/images/logo.webp" alt="Logo" class="h-6 w-auto" />
          </Link>
          <p>&copy; 2025 Vet&Care. Todos los derechos reservados.</p>
        </div>

        <!-- Menú -->
        <div class="relative">
          <button @click="toggleMenu" class="flex items-center hover:text-gray-400 focus:outline-none">
            <span>Información Legal</span>
            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.084l3.71-3.854a.75.75 0 111.08 1.04l-4.25 4.417a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </button>

          <div
            v-if="menuOpen"
            class="absolute right-0 bottom-full mb-2 w-48 bg-white text-gray-800 rounded shadow-md z-10"
          >
            <a href="/aviso-legal" class="block px-4 py-2 hover:bg-gray-100">Aviso Legal</a>
            <a href="/politica-privacidad" class="block px-4 py-2 hover:bg-gray-100">Política de Privacidad</a>
            <a href="/politica-cookies" class="block px-4 py-2 hover:bg-gray-100">Política de Cookies</a>
            <a href="/accesibilidad" class="block px-4 py-2 hover:bg-gray-100">Accesibilidad</a>
          </div>
        </div>
      </div>
    </footer>
    </AppLayout>
</template>
