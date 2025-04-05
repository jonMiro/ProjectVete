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
