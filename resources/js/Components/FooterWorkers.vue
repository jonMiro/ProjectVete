<template>
    <footer class="bg-gray-800 text-white py-4 mt-10">
      <div class="max-w-6xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center text-xs w-full">

        <!-- Logo + Copyright -->
        <div class="flex flex-col items-center sm:items-start mb-4 sm:mb-0 space-y-2 text-center sm:text-left">
          <Link :href="route('dashboard')" class="flex items-center space-x-2">
            <img src="/images/logo.webp" alt="Logo" class="h-6 w-auto" />
            <p>&copy; 2025 Vet&Care. Todos los derechos reservados.</p>
          </Link>
        </div>

        <!-- Iconos redes sociales -->
        <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-10">
          <div class="flex space-x-4 text-gray-400">
            <a href="https://www.facebook.com/" target="_blank" class="hover:text-indigo-500">
              <i class="fab fa-facebook-square text-xl"></i>
            </a>
            <a href="https://www.instagram.com/" target="_blank" class="hover:text-indigo-500">
              <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="https://es.linkedin.com/" target="_blank" class="hover:text-indigo-500">
              <i class="fab fa-linkedin text-xl"></i>
            </a>
          </div>

          <!-- Dirección y mapa -->
          <div class="flex items-center space-x-2 text-gray-400">
            <a
              href="https://www.google.com/maps/place/38%C2%B049'08.0%22N+0%C2%B036'22.0%22W"
              target="_blank"
              rel="noopener noreferrer"
              class="hover:text-indigo-500"
            >
              <i class="fas fa-map-marked-alt text-xl"></i>
            </a>
            <span class="text-gray-300">Avenida Almaig, Ontinyent.</span>
          </div>
        </div>

        <!-- Menú legal -->
        <div class="relative mt-4 sm:mt-0">
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
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import { Link } from '@inertiajs/vue3'

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
