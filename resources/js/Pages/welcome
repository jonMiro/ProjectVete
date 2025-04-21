<script setup>
    import { Head, Link } from '@inertiajs/vue3';

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
    <div>
         <!-- Barra de navegación de autenticación -->
    <nav v-if="canLogin" class="px-4 py-2 flex justify-end bg-white shadow-sm">
      <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
      >
        Dashboard
      </Link>

      <template v-else>
        <Link
          :href="route('login')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
          Log in
        </Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
          Register
        </Link>
      </template>
    </nav>

      <!-- BIENVENIDA -->
      <section id="portal" class="py-24 bg-white min-h-screen">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center md:items-start gap-10">
          <!--image-->
          <div class="md:w-1/2 w-full">
            <img src="/images/work.jpg" alt="Equipo Vet&Care" class="w-full rounded-lg shadow-md object-cover h-full" />
          </div>

          <!--texto bienvenida -->
          <div class="md:w-1/2 w-full text-left">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Bienvenido a Vet&Care</h1>
            <p class="text-lg text-gray-600 mb-4">
              En <strong>Vet&Care</strong> nos apasiona el cuidado animal. Somos una clínica veterinaria centrada en el bienestar integral de tus mascotas,
              combinando profesionalismo, cariño y tecnología para ofrecerte una experiencia única.
            </p>
            <p class="text-gray-600">
              Nuestro equipo está formado por veterinarios, auxiliares y especialistas que te acompañarán en cada etapa: desde el nacimiento de tu mascota
              hasta su cuidado diario, su alimentación, sus consultas y más.
            </p>
          </div>
        </div>
      </section>

      <!-- ¿Qué puedes hacer en Vet&Care? -->
      <section class="py-8 bg-white text-center">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">¿Qué puedes hacer en Vet&Care?</h2>

        <div class="px-6 sm:px-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
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

      <!-- Servicios Concertados -->
      <section id="servicios" class="py-12 bg-gray-50 text-center">
        <div class="max-w-4xl mx-auto px-4">
          <h2 class="text-2xl font-semibold text-gray-800 mb-6">Servicios ofrecidos por nuestras clínicas</h2>
          <p class="text-gray-600 mb-8">
            Ofrecemos una variedad de servicios especializados para garantizar el cuidado integral de tus mascotas, con condiciones especiales para afiliados.
          </p>

          <div class="grid gap-4 text-left sm:grid-cols-2 md:grid-cols-3">
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Castraciones</h3><p class="text-sm text-gray-700">Castraciones</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Esterilizaciones</h3><p class="text-sm text-gray-700">Esterilizaciones</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Eutanasia</h3><p class="text-sm text-gray-700">Eutanasia ética y compasiva</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Hospitalización</h3><p class="text-sm text-gray-700">Monitoreo y cuidado durante recuperación</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Medios de diagnóstico</h3><p class="text-sm text-gray-700">Análisis clínicos, citología, ecografías,<br />ECG, radiografías</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Odontología canina</h3><p class="text-sm text-gray-700">Limpieza dental, extracciones, revisión bucal</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Tratamientos</h3><p class="text-sm text-gray-700">Fluidoterapia</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Vacunaciones</h3><p class="text-sm text-gray-700">Vacunas esenciales y complementarias</p></div>
            <div class="bg-white rounded-lg shadow p-4"><h3 class="font-bold text-blue-700 mb-1">Veterinaria</h3><p class="text-sm text-gray-700">Consultas y visitas generales</p></div>
          </div>
        </div>
      </section>

      <!-- Horarios -->
      <section id="horarios" class="relative bg-gray-100">
        <div class="relative h-96 md:h-[500px]">
          <img src="/images/gato1.png" alt="Horario Vet&Care" class="w-full h-full object-cover" />
          <div class="absolute top-1/2 right-6 transform -translate-y-1/2 bg-white bg-opacity-90 p-6 rounded-lg shadow-lg w-11/12 md:w-3/4 lg:w-2/3 max-w-sm">
            <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">HORARIO</h3>
            <ul class="space-y-2 text-gray-700 text-base text-center">
              <li><strong>Lunes:</strong> 10:00 - 20:00</li>
              <li><strong>Martes:</strong> 10:00 - 20:00</li>
              <li><strong>Miércoles:</strong> 10:00 - 20:00</li>
              <li><strong>Jueves:</strong> 10:00 - 20:00</li>
              <li><strong>Viernes:</strong> 10:00 - 20:00</li>
              <li><strong>Sábado:</strong> 10:30 - 13:30</li>
              <li><strong>Domingo:</strong> Cerrado</li>
            </ul>
          </div>
        </div>
      </section>

      <!-- Formulario de contacto -->
      <section class="bg-white py-12">
        <div class="container mx-auto px-4">
          <div class="bg-white p-8 rounded-lg shadow-lg flex flex-col md:flex-row items-center md:items-start gap-8">
            <div class="w-full md:w-1/2">
              <div class="bg-gray-100 p-6 rounded-md shadow-inner">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center md:text-left">¿Tienes alguna duda?</h3>
                <form action="#" method="POST" class="space-y-4">
                  <div><label for="name" class="block text-sm font-medium text-gray-700">Nombre</label><input type="text" id="name" name="name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" /></div>
                  <div><label for="pet_name" class="block text-sm font-medium text-gray-700">Nombre de tu mascota</label><input type="text" id="pet_name" name="pet_name" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" /></div>
                  <div><label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label><input type="tel" id="phone" name="phone" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm" /></div>
                  <div><label for="pet_type" class="block text-sm font-medium text-gray-700">¿Para quién necesitas la consulta?</label>
                    <select id="pet_type" name="pet_type" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm">
                      <option value="dog">Perro</option>
                      <option value="cat">Gato</option>
                      <option value="other">Otro</option>
                    </select>
                  </div>
                  <div><label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label><textarea id="message" name="message" rows="3" required class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm"></textarea></div>
                  <div class="flex justify-center"><button type="submit" class="w-full md:w-auto py-2 px-6 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Enviar</button></div>
                </form>
              </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center">
              <img src="/images/perro1.jpg" alt="Veterinaria feliz con perro" class="w-full max-w-sm rounded-lg shadow-md object-cover" />
            </div>
          </div>
        </div>
      </section>

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

      <!-- Footer -->
      <Footer />

    </div>
  </template>
