<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBarVolver from '@/Components/NavBarVolver.vue';
import Footer from '@/Components/Footer.vue';
import Contacto from '@/Components/Contacto.vue';
import { Link } from '@inertiajs/vue3';


defineProps({
        canLogin: {
            type: Boolean,
        },
        canRegister: {
            type: Boolean,
        },
        laravelVersion: {
            type: String,
            required: true,
        },
        phpVersion: {
            type: String,
            required: true,
        },
    });
</script>

<template>

  <div class="min-h-screen bg-white">
    <nav class="bg-white border-b border-gray-100">
      <!-- Primary Navigation Menu -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo and Title -->
            <div class="shrink-0 flex items-center space-x-3 -ml-px">
              <Link href="/">
                <img src="/images/logo.webp" alt="Logo" class="block h-16 w-auto" />
              </Link>
              <span class="text-xl font-semibold text-gray-800">Vet&Care</span>
            </div>
          </div>

          <!-- Login / Register / Dashboard -->
          <div v-if="canLogin" class="flex items-center space-x-4">
            <template v-if="$page.props.auth.user">
              <Link
                :href="route('dashboard')"
                class="rounded-md px-4 py-2 text-gray-400 hover:text-gray-600 transition"
              >
                Dashboard
              </Link>
            </template>

            <template v-else>
              <Link
                :href="route('login')"
                class="rounded-md px-4 py-2 text-gray-400 hover:text-gray-600 transition"
              >
                Log in
              </Link>

              <Link
                v-if="canRegister"
                :href="route('register')"
                class="rounded-md px-4 py-2 text-gray-400 hover:text-gray-600 transition"
              >
                Register
              </Link>
            </template>
          </div>
        </div>
      </div>
    </nav>
<NavBarVolver />

    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
      <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Política de Accesibilidad</h1>
      <p class="text-center text-gray-600 mb-6">
        Actualizado: Marzo 2025.
      </p>

      <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">General</h2>
      <p class="text-gray-700 mb-4">
        Vet&Care se esfuerza por que sus servicios sean accesibles para personas con discapacidad. Vet&Care ha invertido una importante cantidad de recursos para ayudar a garantizar que su sitio web sea más fácil de usar y más accesible para las personas con discapacidad, con la firme convicción de que toda persona tiene derecho a vivir con dignidad, igualdad, comodidad e independencia.
      </p>

      <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Accesibilidad en Vet&Care.com</h2>
      <p class="text-gray-700 mb-4">
        Vet&Care pone a disposición el widget de accesibilidad del sitio web UserWay, que funciona con un servidor de accesibilidad dedicado. El software permite a Vet&Care mejorar su cumplimiento de las Pautas de Accesibilidad al Contenido Web (WCAG 2.1).
      </p>

      <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Habilitar el Menú de Accesibilidad</h2>
      <p class="text-gray-700 mb-4">
        El menú de accesibilidad de Vet&Care se puede habilitar presionando la tecla <strong>Tab</strong> cuando se carga la página por primera vez o haciendo clic en el ícono del menú de accesibilidad que aparece en la esquina izquierda en la parte baja de la página. Después de activar el menú de accesibilidad, espere un momento hasta que se cargue por completo.
      </p>

      <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Descargo de Responsabilidad</h2>
      <p class="text-gray-700 mb-4">
        Vet&Care continúa sus esfuerzos para mejorar constantemente la accesibilidad de su sitio y sus servicios en la creencia de que es nuestra obligación moral colectiva permitir un uso fluido, accesible y sin obstáculos también para aquellos de nosotros con discapacidad.
      </p>
      <p class="text-gray-700 mb-4">
        En un esfuerzo continuo por mejorar y solucionar continuamente los problemas de accesibilidad, también escaneamos periódicamente Vet&Care con el Escáner de Accesibilidad de UserWay para identificar y solucionar todas las posibles barreras de accesibilidad en nuestro sitio.
      </p>
      <p class="text-gray-700 mb-4">
        A pesar de nuestros esfuerzos por hacer que todas las páginas y contenidos de Vet&Care sean totalmente accesibles, es posible que algunos contenidos aún no se hayan adaptado completamente a los más estrictos estándares de accesibilidad. Esto puede deberse a no haber encontrado o identificado la solución tecnológica más adecuada.
      </p>

      <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Aquí para Ti</h2>
      <p class="text-gray-700 mb-4">
        Si tiene dificultades con algún contenido de Vet&Care o necesita ayuda con cualquier parte de nuestro sitio, comuníquese con nosotros durante el horario comercial normal como se detalla a continuación y estaremos encantados de ayudarle.
      </p>

      <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Contáctenos</h2>
      <p class="text-gray-700 mb-4">
        Si desea reportar un problema de accesibilidad, tiene alguna pregunta o necesita ayuda, comuníquese con Atención al Cliente de Vet&Care de la siguiente manera:
      </p>
      <ul class="list-disc pl-5 text-gray-700 mb-6">
        <li><strong>Email:</strong> <a href="mailto:cvvet&care@hotmail.com" class="text-blue-600 hover:text-blue-800">cvvet&care@hotmail.com</a></li>
        <li><strong>Teléfono:</strong> (123) 456-7890</li>
      </ul>
    </div>

    <div class="mt-10">
      <Contacto />
    </div>
</div>
    <Footer />
</template>
