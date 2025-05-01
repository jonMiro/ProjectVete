<template>
    <div>
      <h1>Detalles del Animal</h1>

      <div v-if="animal">
        <h2>{{ animal.nombre }}</h2>
        <p><strong>Tipo:</strong> {{ animal.tipo }}</p>
        <p><strong>Raza:</strong> {{ animal.raza }}</p>
        <p><strong>Sexo:</strong> {{ animal.sexo }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ animal.fechaNacimiento }}</p>
        <p><strong>Observaciones:</strong> {{ animal.observaciones }}</p>

        <div v-if="animal.user">
          <h3>Propietario</h3>
          <p><strong>Nombre:</strong> {{ animal.user.nombre }}</p>
          <p><strong>Email:</strong> {{ animal.user.email }}</p>
        </div>
      </div>

      <div v-else>
        <p>No tienes animales asociados. <a :href="route('animales.create')">Crea uno</a>.</p>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      animal: Object,
    },
  }
  </script>

  <style scoped>
  </style>
