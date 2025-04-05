### MEMORIAS DIA 1-2-3
1. Migraciones y Subclases de Usuario
Migraciones: Empezamos creando las migraciones para las tablas de la base de datos. Configuramos las migraciones de Laravel para la tabla users y comenzamos a gestionar los campos que luego serían relevantes para las subclases de usuario.

Subclases de Usuario: Decidimos implementar diferentes tipos de usuarios, creando subclases de la tabla users. Esto nos permitió definir un sistema de usuarios con diferentes roles o tipos, utilizando herencia o relaciones para organizarlos en clases específicas.

Una vez gestionadas las relaciones creamos la tabla animales, luego servicios y consultas

Relaciones entre Subclases: Definimos las relaciones en la base de datos, tales como las claves foráneas y los datos asociados con cada tipo de usuario.

2. Seeds
Generación de Seeds: Creaste y configuraste los seeds para poblar las tablas de la base de datos con datos de ejemplo. Usamos los seeds para automatizar la inserción de información en las tablas, lo que facilitó las pruebas y desarrollo sin tener que ingresar datos manualmente.

Seeder para Usuarios: Escribimos un seeder para crear usuarios, que incluía tanto la creación de usuarios principales como los de las subclases.

3. Trabajo con Inertia, Vue y Vite (Front-end)
Configuración de Vue e Inertia: Establecimos Vue y Inertia.js como parte de tu stack de trabajo para la parte front-end. Inertia se utilizó para que las vistas puedan ser renderizadas en el lado del cliente sin hacer un full page reload.

Estructura del Proyecto: Configuramos la estructura de las vistas en Vue, creando componentes dentro de la carpeta Pages y permitiendo que la interacción con las vistas sea más dinámica y fluida.

Pantallas Personalizadas: Trabajamos en personalizar las pantallas y plantillas, como la modificación de los títulos en el navegador (agregando el nombre "Vet&Care" y cambiando el logo).

4. Iconos y Logo
Cambio del Logo: Configuramos y cambiamos el logo de Laravel por tu propio logo en la interfaz, asegurándonos de que el logo se vea correctamente tanto en la página como en las pestañas del navegador.

Icono de la Pestaña: Cambiamos el icono de la pestaña del navegador a tu propio icono en lugar del predeterminado de Laravel.

5. Ajustes Finales en las Vistas
Títulos y Pestañas: Personalizamos los títulos de las páginas, incluyendo "Vet&Care" como parte de los títulos de las páginas, en lugar de "Laravel".

Interacción y Navegación: Ajustamos y mejoramos la interacción en el sitio, incluyendo la navegación a través de Inertia y Vue, garantizando que el proyecto fuera más dinámico.

Resumen General:
Backend: Implementación de migraciones, seeds y subclases de usuario en Laravel.

Frontend: Uso de Vue con Inertia para manejar el lado cliente, personalización de vistas, títulos y el icono de la pestaña.

Personalización: Cambios en los logos y en los títulos de las páginas para adaptarlos a tu marca "Vet&Care".
