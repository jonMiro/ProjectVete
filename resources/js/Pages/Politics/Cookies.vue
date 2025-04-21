<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import NavBarVolver from '@/Components/NavBarVolver.vue';
import Footer from '@/Components/Footer.vue';
import Contacto from '@/Components/Contacto.vue';
</script>

<template>
  <AppLayout title="Política de Cookies - Vet&Care">
    <template #header>
      <NavBarVolver />
    </template>

    <div class="max-w-5xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8">
      <h1 class="text-3xl font-bold text-center text-gray-800 mb-4">Política de Cookies</h1>
      <p class="text-center text-gray-600 mb-6">Actualizado: Marzo 2025.</p>

      <div class="text-gray-700 text-base space-y-6">
        <p>
          En esta web utilizamos cookies para mejorar la experiencia de navegación y ofrecer servicios personalizados. Al continuar navegando en este sitio web, aceptas el uso de cookies conforme a nuestra Política de Cookies.
        </p>
        <p>
          Las cookies son pequeños archivos de texto que se almacenan en el dispositivo del usuario cuando visita una página web. Estas cookies permiten que la web recuerde información sobre tu visita, como el idioma preferido y otras opciones, lo que mejora la experiencia de navegación y hace que el sitio sea más eficiente.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">¿Qué Son las Cookies?</h2>
        <p>
          Las cookies son pequeños archivos de texto que se descargan en el dispositivo del usuario (ordenador, tablet o smartphone) al acceder a determinadas páginas web. Estas permiten a la web recordar información sobre la navegación del usuario, como las preferencias y las acciones realizadas, con el fin de ofrecer una experiencia más fluida y personalizada.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Tipos de Cookies que Utilizamos</h2>
        <p>En esta web utilizamos tanto cookies propias como de terceros. A continuación, te detallamos los tipos de cookies que se pueden instalar en tu dispositivo:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li><strong>Cookies Propias:</strong> Instaladas directamente desde nuestra web para facilitar la navegación y las funcionalidades básicas del sitio.</li>
          <li><strong>Cookies de Terceros:</strong> Instaladas por servicios externos, como redes sociales o plataformas de análisis, para realizar tareas como el análisis de tráfico o el seguimiento de la actividad de usuarios.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">¿Para Qué Utilizamos las Cookies?</h2>
        <p>Utilizamos cookies para mejorar la funcionalidad de nuestro sitio web y ofrecerte una experiencia personalizada. Las finalidades específicas son:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li>Gestionar la sesión de usuario.</li>
          <li>Recoger estadísticas de uso del sitio web mediante herramientas de análisis.</li>
          <li>Personalizar el contenido y los anuncios.</li>
          <li>Ofrecer contenido multimedia desde plataformas externas.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">¿Cómo Puedo Desactivar las Cookies?</h2>
        <p>
          Puedes configurar tu navegador para aceptar o rechazar las cookies, o incluso para que te avise cuando una cookie esté siendo instalada. Sin embargo, si decides desactivarlas, algunas partes del sitio web pueden no funcionar correctamente. Aquí te explicamos cómo hacerlo en los navegadores más comunes:
        </p>
        <ul class="list-disc pl-5 space-y-2">
          <li><strong>Google Chrome:</strong> Ajustes &gt; Privacidad y seguridad &gt; Cookies y otros datos de sitios &gt; Configuración.</li>
          <li><strong>Mozilla Firefox:</strong> Opciones &gt; Privacidad y seguridad &gt; Cookies y datos del sitio.</li>
          <li><strong>Safari:</strong> Preferencias &gt; Privacidad &gt; Bloquear todas las cookies.</li>
          <li><strong>Microsoft Edge:</strong> Configuración &gt; Privacidad, búsqueda y servicios &gt; Cookies y datos del sitio.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Cookies que Utilizamos en Este Sitio Web</h2>
        <p>Las cookies que utilizamos en este sitio son las siguientes:</p>
        <ul class="list-disc pl-5 space-y-2">
          <li><strong>Cookies Técnicas:</strong> Necesarias para la navegación por el sitio y la correcta funcionalidad del mismo.</li>
          <li><strong>Cookies Analíticas:</strong> Utilizamos cookies de Google Analytics para realizar un análisis estadístico sobre el uso del sitio web.</li>
          <li><strong>Cookies de Publicidad:</strong> Usamos cookies para personalizar los anuncios que mostramos a los usuarios basados en su comportamiento de navegación.</li>
        </ul>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Modificaciones en la Política de Cookies</h2>
        <p>
          Nos reservamos el derecho de modificar esta Política de Cookies en cualquier momento. Cualquier cambio será publicado en esta misma página, por lo que te recomendamos que la consultes regularmente.
        </p>

        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-3">Más Información</h2>
        <p>
          Si deseas obtener más información sobre el uso de cookies, puedes visitar nuestra <a href="/politica-privacidad" class="text-blue-600 hover:text-blue-800">Política de Privacidad</a> o escribirnos a <a href="mailto:cvvet&care@hotmail.com" class="text-blue-600 hover:text-blue-800">cvvet&care@hotmail.com</a>.
        </p>
      </div>
    </div>

    <div class="mt-10">
      <Contacto />
    </div>

    <Footer />
  </AppLayout>
</template>
