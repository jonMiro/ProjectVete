<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class PageController extends Controller
{
        public function avisoLegal()
        {
            return Inertia::render('Politics/AvisoLegal',[
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        }


        public function politicaPrivacidad()
        {
            return Inertia::render('Politics/Privacidad',[
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        }

        public function politicaCookies()
        {
            return Inertia::render('Politics/Cookies',[
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        }

        public function accesibilidad()
        {
            return Inertia::render('Politics/Accesibilidad',[
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        }
    }
