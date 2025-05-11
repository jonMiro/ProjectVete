#!/bin/bash

# Limpiar y cachear config, rutas y vistas
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones
php artisan migrate --force
