<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\AltaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnimalUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HistorialController;





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



Route::prefix('clients')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Clients/ClientsDashboard');
    })->name('clients');

    Route::resource('eventos', EventController::class);

      // Mostrar los animales asociados al cliente
      Route::get('animales', [AnimalUserController::class, 'index'])->name('clients.animales.index');

      // Editar, crear un animal
      Route::get('animales/{animal}/edit', [AnimalUserController::class, 'edit'])->name('clients.animales.edit');
      Route::put('animales/{animal}', [AnimalUserController::class, 'update'])->name('clients.animales.update');
      Route::get('animales/create', [AnimalUserController::class, 'create'])->name('clients.animales.create');
      Route::post('animales', [AnimalUserController::class, 'store'])->name('clients.animales.store');

      Route::get('historial', [HistorialController::class, 'index'])->name('clients.historial.index');
      Route::get('historial/consulta/{id}', [HistorialController::class, 'showConsulta'])->name('clients.historial.showConsulta');
      Route::get('historial/servicio/{id}', [HistorialController::class, 'showServicio'])->name('clients.historial.showServicio');
      Route::get('historial/evento/{id}', [HistorialController::class, 'showEvento'])->name('clients.historial.showEvento');

      Route::delete('historial/consulta/{id}', [HistorialController::class, 'destroyConsulta'])->name('clients.historial.destroyConsulta');
      Route::delete('historial/servicio/{id}', [HistorialController::class, 'destroyServicio'])->name('clients.historial.destroyServicio');
      Route::delete('historial/evento/{id}', [HistorialController::class, 'destroyEvento'])->name('clients.historial.destroyEvento');



      Route::middleware('auth')->get('posts/myposts', [PostController::class, 'myPosts'])->name('posts.myposts');
      Route::resource('posts', PostController::class);
    });


    // Crear un evento
   // Route::get('/eventos/create', [EventController::class, 'create'])->name('clients.events.create');
    //Route::post('/eventos', [EventController::class, 'store'])->name('clients.storeEvent');


Route::prefix('workers')->group(function () {
    // Dashboard
    Route::get('/', function () {
        return Inertia::render('Workers/WorkersDashboard');
    })->name('workers');

    // Búsqueda
    Route::resource('search', SearchController::class)->only(['index']);

    // Animales
    Route::resource('animales', AnimalController::class);

    // Usuarios
    Route::resource('users', UserController::class);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Consultas
    Route::resource('consultas', ConsultaController::class);
    Route::put('/consultas/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');



    // Servicios
    Route::resource('servicios', ServicioController::class);
    // routes/web.php
Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');


    // Facturación
    Route::get('facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');

    Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas.index');



    Route::get('alta', [AltaController::class, 'index'])->name('alta.index');
    Route::post('alta/user', [AltaController::class, 'storeUser'])->name('alta.storeUser');
    Route::post('alta/animal', [AltaController::class, 'storeAnimal'])->name('alta.storeAnimal');
    Route::post('alta/servicio', [AltaController::class, 'storeServicio'])->name('alta.storeServicio');
    Route::post('alta/consulta', [AltaController::class, 'storeConsulta'])->name('alta.storeConsulta');



});




Route::get('/aviso-legal', [PageController::class, 'avisoLegal'])->name('aviso-legal');
Route::get('/politica-privacidad', [PageController::class, 'politicaPrivacidad'])->name('politica-privacidad');
Route::get('/politica-cookies', [PageController::class, 'politicaCookies'])->name('politica-cookies');
Route::get('/accesibilidad', [PageController::class, 'accesibilidad'])->name('accesibilidad');

//Route::get('/workers/search', function () {
 //   return Inertia::render('Workers/Search');
//})->name('workers.search');




/*Route::prefix('workers')->group(function () {
    // Rutas para el Dashboard de Workers
    Route::get('/', function () {
        return Inertia::render('Workers/WorkersDashboard');
    })->name('workers');


    Route::resource('search', SearchController::class); // CRUD completo
    Route::get('search', [SearchController::class, 'index'])->name('search.index');


    // Rutas para el CRUD de Animales dentro de /workers
    Route::resource('animales', AnimalController::class); // CRUD completo

    // Rutas específicas para mostrar y eliminar
    Route::get('animales/{id}', [AnimalController::class, 'show'])->name('animales.show');
    Route::delete('animales/{id}', [AnimalController::class, 'destroy'])->name('animales.destroy');

    Route::resource('users', UserController::class);

    Route::resource('consultas', ConsultaController::class);
    Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
    // Ruta para mostrar los detalles de una consulta
    Route::get('/consultas/{id}', [ConsultaController::class, 'show'])->name('consultas.show');

    // routes/web.php

    Route::resource('servicios', ServicioController::class);

    // routes/web.php

Route::get('/facturacion', [App\Http\Controllers\FacturacionController::class, 'index'])->name('facturacion.index');

});*/
