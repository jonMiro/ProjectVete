<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Ruta para obtener el usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



