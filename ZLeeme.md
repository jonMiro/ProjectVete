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

### Memorias 

# Dia 1-2-3
Hicimos las migraciones, seeders, y un poco de estilo en el dashboard y welcome, 

### Faltaria por añadir las migraciones de los posts (cliente) y de las guias(veterinarios) 

