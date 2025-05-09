<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBarVolver from '@/Components/NavBarVolver.vue';
import FooterWorkers from '@/Components/FooterWorkers.vue';
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
              <Link :href="route('dashboard')">
                <img src="/images/logo.webp" alt="Logo" class="block h-16 w-auto" />
              </Link>
              <span class="text-xl font-semibold text-gray-800">Vet&Care</span>
              <Link :href="route('workers')" class="text-blue-600 hover:underline text-lg block text-center">
                Workers
              </Link>
              <Link :href="route('clients')" class="text-green-600 hover:underline text-lg block text-center">
                Clientes
              </Link>
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
      <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Aviso Legal</h1>
      <p class="text-center text-gray-600 mb-6">Actualizado: Marzo 2025.</p>

      <div class="text-gray-700 text-base space-y-6">
        <p><strong>Responsable:</strong> JONATHAN ALCOBENDAS MIRÓ</p>
        <p><strong>Nombre comercial:</strong> VET&CARE</p>
        <p><strong>NIF/CIF:</strong> 48604293A</p>
        <p><strong>Dirección:</strong> C/ Falsa, 123, 46870 Ontinyent, Valencia, España.</p>
        <p><strong>Correo electrónico:</strong> <a href="mailto:cvvet&care@hotmail.com" class="text-blue-600 hover:text-blue-800">cvvet&care@hotmail.com</a></p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Términos y Condiciones Legales</h2>
        <p>
          En este espacio, podrás encontrar toda la información relativa a los términos y condiciones legales que definen las relaciones entre los usuarios de la web y los responsables de la misma. Como usuario de nuestra web, es importante que conozcas estos términos antes de continuar tu navegación.
        </p>
        <p>
          JONATHAN ALCOBENDAS MIRÓ (Programador) como responsable de esta web, asume el compromiso de tratar la información de los usuarios y clientes con plenas garantías y cumplir con los requisitos nacionales y europeos que regulan la recopilación y uso de los datos personales de nuestros usuarios.
        </p>
        <p>
          Esta web se adapta a las exigencias del Reglamento (UE) 2016/679 (RGPD), así como a la Ley 34/2002 (LSSICE).
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Condiciones Generales de Uso</h2>
        <p>
          Las presentes Condiciones Generales regulan el uso (incluyendo el mero acceso) de las páginas de web, incluidos los contenidos y servicios puestos a disposición en ellas. Toda persona que acceda a la web vetandcare.com lo hace en condición de usuario y acepta someterse a las Condiciones Generales vigentes.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Datos Personales que Recabamos y Cómo lo Hacemos</h2>
        <p>
          Toda la información relativa a los datos personales que recogemos y cómo los gestionamos, puedes consultarla en nuestra <a href="/politica-privacidad" class="text-blue-600 hover:text-blue-800">Política de privacidad</a>.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Compromisos y Obligaciones de los Usuarios</h2>
        <p>
          El usuario acepta que el acceso a esta web no supone, en modo alguno, el inicio de una relación comercial. Se compromete a usar el sitio conforme a la legislación vigente, la buena fe y el orden público. Está prohibido el uso de la web con fines ilícitos o dañinos.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Medidas de Seguridad</h2>
        <p>
          Los datos personales podrán almacenarse en bases de datos bajo la titularidad de Vet&Care, con las medidas técnicas, organizativas y de seguridad que garanticen su confidencialidad e integridad.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Derechos de Propiedad Intelectual e Industrial</h2>
        <p>
          Quedan prohibidas la reproducción, distribución y comunicación pública de los contenidos de esta web con fines comerciales, sin la autorización de Vet&Care.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Exclusión de Garantías y Responsable</h2>
        <p>
          Vet&Care no se hace responsable de los daños que pudieran derivarse del uso de la web, ni garantiza la ausencia de malware o errores.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Ley Aplicable y Jurisdicción</h2>
        <p>
          Las relaciones entre Vet&Care y los usuarios de sus servicios están sometidas a la legislación española y a los tribunales de Valencia.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Contacto</h2>
        <p>
          Para cualquier duda o comentario, puedes escribirnos a <a href="mailto:cvvet&care@hotmail.com" class="text-blue-600 hover:text-blue-800">cvvet&care@hotmail.com</a>.
        </p>
      </div>
    </div>

    <div class="mt-10">
      <Contacto />
    </div>
</div>

    <FooterWorkers />
</template>
