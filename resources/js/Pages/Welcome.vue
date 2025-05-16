<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import FooterWorkers from '@/Components/FooterWorkers.vue';
    import NavBarClients from '@/Components/NavBarMainPage.vue';

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

    function handleImageError() {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    }
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
                Registrar
              </Link>
            </template>
          </div>
        </div>
      </div>
    </nav>

    <div>

    </div>



          <!--texto bienvenida -->
          <!-- BIENVENIDA -->
<section id="portal" class="py-12 bg-white min-h-screen">

     <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center ">Bienvenido a Vet&Care</h1>
  <div class="container mx-auto px-4 flex flex-col md:flex-row items-center md:items-start gap-10">
    <!-- Imagen -->
    <div class="md:w-1/2 w-full">
      <img src="/images/vete.jpg" alt="Equipo Vet&Care" class="w-full rounded-lg shadow-md object-cover h-full" />
    </div>



    <!-- Primer bloque de texto -->
    <div class="md:w-1/2 w-full">


      <p class="text-lg text-gray-600 mb-4">
        Las clínicas veterinarias cada vez más tienen la necesidad de ofrecer un servicio más ágil, modernizado, accesible y adaptado a las nuevas necesidades de sus clientes.
      </p>
      <p class="text-lg text-gray-600 mb-6">
        Bajo este contexto se crea nuestra empresa Vet&Care para marcar la diferencia. Nuestra plataforma no es una simple página web, sino una solución integral que permite a las clínicas veterinarias digitalizar su negocio, conectando el sistema de gestión con un portal intuitivo, útil e inmersivo para los clientes.
      </p>

    </div>
  </div>



  <!-- Segundo bloque de texto -->
  <div class="w-full px-8 mt-16">
    <p class="text-xl text-gray-600 mb-6 text-center">
        <strong>Vet&Care está dividida en dos áreas principales:</strong>
      </p>
    <ul class="list-disc list-inside text-lg text-gray-600 mb-6 text-center">
      <li><strong>Área cerrada de gestión para las clínicas veterinarias</strong></li>
      <p class="text-lg text-gray-600 mb-6">
        Esta sección está destinada para gestionar todos los tipos de datos, desde usuarios, clientes, animales hasta consultas, servicios, facturación y acceso a gráficas personalizadas.
      </p>
      <!-- ¿Qué puedes gestionar en Vet&Care? -->
<section class="py-12 bg-white text-center">
  <div class="px-6 sm:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
        <img src="/icons/gestion.png" alt="Icono Usuarios" class="w-16 h-16 mb-4" />
        <h3 class="text-xl font-semibold">Usuarios i animales</h3>
        <p class="text-gray-600 text-sm">Administra toda la información de trabajadores y propietarios de mascotas.</p>
      </div>

      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
        <img src="/icons/calendario.webp" alt="Icono Calendar" class="w-16 h-16 mb-4" />
        <h3 class="text-xl font-semibold">Calendario</h3>
        <p class="text-gray-600 text-sm">Gestiona todas tus citas i consultas en un solo lugar</p>
      </div>

      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
        <img src="/icons/his.webp" alt="Icono Consultas" class="w-16 h-16 mb-4" />
        <h3 class="text-xl font-semibold">Consultas</h3>
        <p class="text-gray-600 text-sm">Lleva un historial médico completo de cada animal atendido.</p>
      </div>

      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
        <img src="/icons/service.png" alt="Icono Servicios" class="w-16 h-16 mb-4" />
        <h3 class="text-xl font-semibold">Servicios</h3>
        <p class="text-gray-600 text-sm">Gestiona los servicios veterinarios prestados y su disponibilidad.</p>
      </div>

      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
        <img src="/icons/credito.webp" alt="Icono Facturación" class="w-16 h-16 mb-4" />
        <h3 class="text-xl font-semibold">Facturación</h3>
        <p class="text-gray-600 text-sm">Visualiza ingresos generados y controla tus operaciones económicas.</p>
      </div>

      <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
        <img src="/icons/gra.webp" alt="Icono Gráficas" class="w-16 h-16 mb-4" />
        <h3 class="text-xl font-semibold">Gráficas</h3>
        <p class="text-gray-600 text-sm">Accede a estadísticas personalizadas para tomar mejores decisiones.</p>
      </div>

    </div>
  </div>
</section>

      <li class="mt-8"><strong>Área abierta para clientes</strong></li>
      <p class="text-lg text-gray-600 mb-6">
        Esta sección está orientada a los clientes y usuarios de la veterinaria. Contiene acceso al historial de los servicios o consultas realizados a nuestras mascotas, permite conectarnos con la comunidad y realizar diversas tareas como comprar en tienda online y reservas de citas.
      </p>
    </ul>
  </div>
</section>


      <!-- ¿Qué puedes hacer en Vet&Care? -->
      <section class=" bg-white text-center">
        <div class="px-6 sm:px-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 px-2 sm:px-6 md:grid-cols-3 gap-6">
            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
              <img src="/icons/profile.png" alt="Icono Perfil" class="w-16 h-16 mb-4" />
              <h3 class="text-xl font-semibold">Mi perfil</h3>
              <p class="text-gray-600 text-sm">Gestiona tu información personal y preferencias fácilmente.</p>
            </div>

            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
              <img src="/icons/pet.png" alt="Icono Mascota" class="w-16 h-16 mb-4" />
              <h3 class="text-xl font-semibold">Administrar mascotas</h3>
              <p class="text-gray-600 text-sm">Añade, edita o elimina información de tus compañeros peludos.</p>
            </div>

            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
              <img src="/icons/social.png" alt="Icono Comunidad" class="w-16 h-16 mb-4" />
              <h3 class="text-xl font-semibold">Comunidad</h3>
              <p class="text-gray-600 text-sm">Conecta con otros usuarios y comparte experiencias.</p>
            </div>

            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
              <img src="/icons/servicios.png" alt="Icono Servicios" class="w-16 h-16 mb-4" />
              <h3 class="text-xl font-semibold">Servicios</h3>
              <p class="text-gray-600 text-sm">Explora los tratamientos, vacunaciones y cuidados disponibles.</p>
            </div>

            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
              <img src="/icons/consultas.png" alt="Icono Consulta" class="w-16 h-16 mb-4" />
              <h3 class="text-xl font-semibold">Consulta</h3>
              <p class="text-gray-600 text-sm">Registra o revisa tus consultas médicas con nuestros profesionales.</p>
            </div>

            <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md">
              <img src="/icons/tiendas.png" alt="Icono Tienda" class="w-16 h-16 mb-4" />
              <h3 class="text-xl font-semibold">Tienda</h3>
              <p class="text-gray-600 text-sm">Accede a productos seleccionados para el bienestar de tus mascotas.</p>
            </div>
          </div>
        </div>
      </section>

      <div class="w-full px-8 mt-16 bg-gray-800 py-12 shadow-lg mb-12">
  <p class="text-lg text-gray-200 mb-6 text-center">
    Le invitamos a descubrir nuestro proyecto a través de este modelo demostrativo, que refleja las capacidades y funcionalidades que podemos ofrecer. Puede registrarse como nuevo usuario o acceder con las credenciales de nuestro cliente piloto:
  </p>

  <div class="bg-gray-700 rounded-lg p-6 max-w-md mx-auto text-center mb-8">
    <p class="text-lg text-white mb-2">
      <strong>Usuario:</strong> cliente1@example.com
    </p>
    <p class="text-lg text-white">
      <strong>Contraseña:</strong> 12345678
    </p>
  </div>

  <div class="flex justify-center space-x-4 mt-8">
    <Link
      :href="route('login')"
      class="rounded-md px-6 py-2 bg-blue-600 text-white font-semibold hover:bg-blue-700 transition"
    >
      Log in
    </Link>

    <Link
      v-if="canRegister"
      :href="route('register')"
      class="rounded-md px-6 py-2 bg-green-600 text-white font-semibold hover:bg-green-700 transition"
    >
      Registrar
    </Link>
  </div>
</div>



      <!-- Contacto -->
      <section id="contacto" class="py-12 bg-white relative">
        <div class="absolute inset-0 z-0"><img src="/images/fonto.jpg" alt="Fondo contacto" class="w-full h-full object-cover" /></div>
        <div class="container mx-auto px-4 relative z-10">
          <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-left border-b pb-2 w-1/2">Contáctanos</h2>
          <div class="flex justify-start">
            <div class="bg-white bg-opacity-90 p-6 rounded-lg shadow-lg w-full md:w-1/2 lg:w-1/3 text-left">
              <div class="flex items-center space-x-2 mb-2"><i class="fas fa-envelope text-xl text-gray-600"></i><h3 class="text-xl font-semibold text-gray-800">Correo Electrónico</h3></div>
              <p class="text-gray-700 mb-6">contacto@vetcare.com</p>

              <div class="flex items-center space-x-2 mb-2"><i class="fas fa-phone-alt text-xl text-gray-600"></i><h3 class="text-xl font-semibold text-gray-800">Teléfono</h3></div>
              <p class="text-gray-700 mb-6">(123) 456-7890</p>

              <div class="flex items-center space-x-2 mb-2"><i class="fas fa-share-alt text-xl text-gray-600"></i><h3 class="text-xl font-semibold text-gray-800">Redes Sociales</h3></div>
              <div class="flex space-x-4 mb-6">
                <a href="https://www.facebook.com/" target="_blank" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-facebook-square text-2xl"></i></a>
                <a href="https://www.instagram.com/" target="_blank" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-instagram text-2xl"></i></a>
                <a href="https://x.com/" target="_blank" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-twitter text-2xl"></i></a>
                <a href="https://es.linkedin.com/" target="_blank" class="text-gray-600 hover:text-indigo-600"><i class="fab fa-linkedin text-2xl"></i></a>
              </div>

              <div class="flex items-center space-x-2 mb-2"><i class="fas fa-map-marker-alt text-xl text-gray-600"></i><h3 class="text-xl font-semibold text-gray-800">Dirección</h3></div>
              <p class="text-gray-700">
                Avenida Almaig, Ontinyent (Valencia), España
                <a href="https://www.google.com/maps/place/38%C2%B049'08.0%22N+0%C2%B036'22.0%22W" class="text-blue-600 hover:underline ml-1" target="_blank">Google Maps</a>
              </p>
            </div>
          </div>
        </div>
      </section>
      <FooterWorkers />

    </div>
  </template>
