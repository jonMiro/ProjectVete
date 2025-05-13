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
use App\Http\Controllers\PostsWorkersController;






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


// CLIENTES
Route::prefix('clients')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Clients/ClientsDashboard');
    })->name('clients');

    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');


      //events
    Route::resource('eventos', EventController::class);

      // animals
    Route::get('animales', [AnimalUserController::class, 'index'])->name('clients.animales.index');
    Route::get('animales/{animal}/edit', [AnimalUserController::class, 'edit'])->name('clients.animales.edit');
    Route::put('animales/{animal}', [AnimalUserController::class, 'update'])->name('clients.animales.update');
    Route::get('animales/create', [AnimalUserController::class, 'create'])->name('clients.animales.create');
    Route::post('animales', [AnimalUserController::class, 'store'])->name('clients.animales.store');
    Route::get('animales/{animal}', [AnimalUserController::class, 'show'])->name('clients.animales.show');
    Route::delete('animales/{animal}', [AnimalUserController::class, 'destroy'])->name('clients.animales.destroy');

    // historial
    Route::get('historial', [HistorialController::class, 'index'])->name('clients.historial.index');
    Route::get('historial/consulta/{id}', [HistorialController::class, 'showConsulta'])->name('clients.historial.showConsulta');
    Route::get('historial/servicio/{id}', [HistorialController::class, 'showServicio'])->name('clients.historial.showServicio');
    Route::get('historial/evento/{id}', [HistorialController::class, 'showEvento'])->name('clients.historial.showEvento');

    Route::delete('historial/consulta/{id}', [HistorialController::class, 'destroyConsulta'])->name('clients.historial.destroyConsulta');
    Route::delete('historial/servicio/{id}', [HistorialController::class, 'destroyServicio'])->name('clients.historial.destroyServicio');
    Route::delete('historial/evento/{id}', [HistorialController::class, 'destroyEvento'])->name('clients.historial.destroyEvento');

    // posts
    Route::middleware('auth')->get('posts/myposts', [PostController::class, 'myPosts'])->name('posts.myposts');
    Route::get('posts/myposts', [PostController::class, 'myPosts'])->name('posts.myposts');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


    Route::get('eventos/create', [EventController::class, 'create'])->name('eventos.create');
    Route::get('eventos/index', [EventController::class, 'indexEventosClient'])->name('eventos.indexClient');


});



 // WORKERS

Route::prefix('workers')->group(function () {

    Route::get('/', function () {
        return Inertia::render('Workers/WorkersDashboard');
    })->name('workers');

    // search
    Route::resource('search', SearchController::class)->only(['index']);

    // animals
    Route::resource('animales', AnimalController::class);
    Route::get('/animales/{animal}/historial', [AnimalController::class, 'historial'])->name('animales.historial');


    // users
    Route::resource('users', UserController::class);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    // Consultas
    Route::resource('consultas', ConsultaController::class);
    Route::put('/consultas/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');



    // Servicios
    Route::resource('servicios', ServicioController::class);
    Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');


    //Facturación
    Route::get('facturacion', [FacturacionController::class, 'index'])->name('facturacion.index');

    //stats
    Route::get('/estadisticas', [EstadisticasController::class, 'index'])->name('estadisticas.index');

    //posts
    Route::get('posts', [PostsWorkersController::class, 'index'])->name('postsworkers.index');
    Route::delete('posts/{post}', [PostsWorkersController::class, 'destroy'])->name('postsworkers.destroy');

    //alta
    Route::get('alta', [AltaController::class, 'index'])->name('alta.index');
    Route::post('alta/user', [AltaController::class, 'storeUser'])->name('alta.storeUser');
    Route::post('alta/animal', [AltaController::class, 'storeAnimal'])->name('alta.storeAnimal');
    Route::post('alta/servicio', [AltaController::class, 'storeServicio'])->name('alta.storeServicio');
    Route::post('alta/consulta', [AltaController::class, 'storeConsulta'])->name('alta.storeConsulta');



});


//no auth

Route::get('/aviso-legal', [PageController::class, 'avisoLegal'])->name('aviso-legal');
Route::get('/politica-privacidad', [PageController::class, 'politicaPrivacidad'])->name('politica-privacidad');
Route::get('/politica-cookies', [PageController::class, 'politicaCookies'])->name('politica-cookies');
Route::get('/accesibilidad', [PageController::class, 'accesibilidad'])->name('accesibilidad');

