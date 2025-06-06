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
      <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Política de Privacidad</h1>
      <p class="text-center text-gray-600 mb-6">Actualizado: Marzo 2025.</p>

      <div class="text-gray-700 text-base space-y-6">
        <p>
          Tu privacidad es importante para nosotros. En esta declaración de privacidad te explicamos qué datos personales recopilamos de nuestros usuarios y cómo los utilizamos. Te animamos a leer detenidamente estos términos antes de facilitar tus datos personales en esta web.
        </p>

        <p>
          En esta web y en las demás webs que son titularidad de Vet&Care (JONATHAN ALCOBENDAS MIRÓ), se respetan y cuidan los datos personales de los usuarios. Como usuario debes saber que tus derechos están garantizados. Queremos compartir nuestros principios respecto a tu privacidad:
        </p>

        <ul class="list-disc pl-5 space-y-2">
          <li>Nunca solicitamos información personal a menos que realmente sea necesaria para prestarte los servicios que requieras.</li>
          <li>Nunca compartimos información personal de nuestros usuarios con nadie, excepto para cumplir con la ley o en caso de que contemos con tu autorización expresa.</li>
          <li>Nunca utilizamos tus datos personales con una finalidad diferente a la expresada en esta política de privacidad.</li>
          <li>Esta Política de Privacidad podría variar por exigencias legislativas o de autorregulación. Se aconseja consultarla periódicamente.</li>
        </ul>

        <p>
          Esta política será aplicable en caso de que los usuarios decidan rellenar cualquiera de nuestros formularios de contacto donde se recaben datos personales. Vet&Care (JONATHAN ALCOBENDAS MIRÓ) ha adecuado esta web a las exigencias del Reglamento (UE) 2016/679 (RGPD).
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Responsable del Tratamiento de Tus Datos Personales</h2>
        <p>
          Responsable: JONATHAN ALCOBENDAS MIRÓ <br>
          Nombre comercial: Vet&Care Society <br>
          NIF/CIF: 48604293A <br>
          Dirección: C/ Falsa, 123, 46870 Ontinyent, (Valencia) – España <br>
          Correo electrónico: <a href="mailto:cvvet&care@hotmail.com" class="text-blue-600 hover:text-blue-800">cvvet&care@hotmail.com</a><br>
          Actividad: Desarrollo ecosistemas virtuales ámbito veterinario.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Principios Relacionados con el Tratamiento de tu Información Personal</h2>
        <ul class="list-disc pl-5 space-y-2">
          <li><strong>Licitud, lealtad y transparencia:</strong> Siempre requeriremos tu consentimiento para tratar tus datos personales para uno o varios fines específicos.</li>
          <li><strong>Minimización de datos:</strong> Solo solicitaremos los datos estrictamente necesarios para los fines requeridos.</li>
          <li><strong>Limitación del plazo de conservación:</strong> Los datos se conservarán solo el tiempo necesario para los fines del tratamiento.</li>
          <li><strong>Integridad y confidencialidad:</strong> Tratamos tus datos de forma que se garantice una seguridad adecuada y confidencialidad.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">¿Cómo Hemos Obtenido Tus Datos?</h2>
        <ul class="list-disc pl-5 space-y-2">
          <li>Formulario de contacto.</li>
          <li>Formulario de suscripción.</li>
          <li>Comentarios en el blog.</li>
          <li>Formulario de registro.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">¿Cuáles Son Tus Derechos Cuando Nos Facilitas Tus Datos?</h2>
        <p>Los usuarios tienen derecho a:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li>Solicitar el acceso a los datos personales.</li>
          <li>Solicitar su rectificación o supresión.</li>
          <li>Solicitar la limitación del tratamiento.</li>
          <li>Oponerse al tratamiento.</li>
          <li>Solicitar la portabilidad de los datos.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">¿Con Qué Finalidad Tratamos Tus Datos Personales?</h2>
        <p>Utilizamos los datos con las siguientes finalidades:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li>Responder a consultas mediante formularios de contacto.</li>
          <li>Enviar boletines y promociones por correo electrónico.</li>
          <li>Gestionar cuentas de usuario registradas en nuestra plataforma.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Remarketing</h2>
        <p>
          Utilizamos técnicas de remarketing para mostrar anuncios personalizados a los usuarios que ya han interactuado con nuestro sitio web.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Legitimación para el Tratamiento</h2>
        <p>
          La base legal para el tratamiento de tus datos es el consentimiento expreso que otorgas al utilizar nuestros servicios y aceptar esta política.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Seguridad de los Datos</h2>
        <p>
          Aplicamos medidas de seguridad técnicas y organizativas para proteger tus datos personales del acceso no autorizado o uso indebido.
        </p>
      </div>
    </div>

    <div class="mt-10">
      <Contacto />
    </div>
</div>

    <FooterWorkers />

</template>
