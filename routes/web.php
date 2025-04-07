<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});



Route::get('/clients', function () {
    return Inertia::render('Clients/ClientsDashboard');
})->name('clients');

//Route::get('/workers/search', function () {
 //   return Inertia::render('Workers/Search');
//})->name('workers.search');


Route::prefix('workers')->group(function () {
    // Rutas para el Dashboard de Workers
    Route::get('/', function () {
        return Inertia::render('Workers/WorkersDashboard');
    })->name('workers');

    // Ruta para la búsqueda de trabajadores
    Route::get('/search', [SearchController::class, 'index'])->name('workers.search');

    // Rutas para el CRUD de Animales dentro de /workers
    Route::resource('animales', AnimalController::class); // CRUD completo

    // Rutas específicas para mostrar y eliminar
    Route::get('animales/{id}', [AnimalController::class, 'show'])->name('animales.show');
    Route::delete('animales/{id}', [AnimalController::class, 'destroy'])->name('animales.destroy');

    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
