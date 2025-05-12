<template>
  <nav class="bg-gray-700 text-white p-3">
    <div class="container mx-auto flex justify-between items-center">
      <ul class="flex space-x-10 justify-center w-full">
        <li>
          <Link
            :href="route('search.index')"
            :class="linkClass('search.index')"
          >Buscar</Link>
        </li>

        <li>
          <Link
            :href="route('alta.index')"
            :class="linkClass('alta.index')"
          >Altas</Link>
        </li>

        <li>
          <Link
            :href="route('consultas.index')"
            :class="linkClass('consultas.index')"
          >Consultas</Link>
        </li>

        <li>
          <Link
            :href="route('servicios.index')"
            :class="linkClass('servicios.index')"
          >Servicios</Link>
        </li>

        <li>
          <Link
            :href="route('facturacion.index')"
            :class="linkClass('facturacion.index')"
          >Facturación</Link>
        </li>

        <li>
          <Link
            :href="route('estadisticas.index')"
            :class="linkClass('estadisticas.index')"
          >DataAnalisis</Link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();

const linkClass = (name) => {
  return route().current(name)
    ? 'text-blue-400 border-b-2 text-lg'
    : 'text-white hover:text-blue-400 text-lg';
};
</script>
