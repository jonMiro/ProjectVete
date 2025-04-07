### Crear proyecto

composer create-project laravel/laravel example-app
cd example-app
composer require laravel/jetstream
php artisan jetstream:install inertia
npm install
npm run dev
php artisan migrate

### Migraciones

php artisan make:migration create_animales_table
php artisan make:migration create_servicios_table
php artisan make:migration create_consultas_table


app.js Cambiar la info del head.
Applayout. Registro, login etc...
Dashboard: importante.
- Utilizar route() para los links <Link :href="route('workers.search')" class="nav-link text-whitehover:text-blue-400 text-lg">Buscar</Link>


### LOGOS, IMAGENES

Si no te entra la imagen o el logo con la ruta nueva utilizar:
<img :src="require('@/public/icons/tiendas.png')"
