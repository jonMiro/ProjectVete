<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
        public function avisoLegal()
        {
            return Inertia::render('Politics/AvisoLegal');
        }

        public function politicaPrivacidad()
        {
            return Inertia::render('Politics/Privacidad');
        }

        public function politicaCookies()
        {
            return Inertia::render('Politics/Cookies');
        }

        public function accesibilidad()
        {
            return Inertia::render('Politics/Accesibilidad');
        }
    }
