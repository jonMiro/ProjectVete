<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Auxiliar;
use App\Models\Veterinario;
use App\Models\Cliente;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->get('search', '');

        $animales = Animal::where('nombre', 'like', "%{$searchQuery}%")
                          ->orWhere('tipo', 'like', "%{$searchQuery}%")
                          ->orWhere('raza', 'like', "%{$searchQuery}%")
                          ->get();

        $auxiliares = Auxiliar::where('nombre', 'like', "%{$searchQuery}%")
                              ->orWhere('apellidos', 'like', "%{$searchQuery}%")
                              ->get();

        $veterinarios = Veterinario::where('nombre', 'like', "%{$searchQuery}%")
                                   ->orWhere('apellidos', 'like', "%{$searchQuery}%")
                                   ->orWhere('especialidad', 'like', "%{$searchQuery}%")
                                   ->get();

        $clientes = Cliente::where('nombre', 'like', "%{$searchQuery}%")
                           ->orWhere('apellidos', 'like', "%{$searchQuery}%")
                           ->get();

                           return Inertia::render('Workers/Search', [
                            'search' => $searchQuery,
                            'animales' => $animales,
                            'auxiliares' => $auxiliares,
                            'veterinarios' => $veterinarios,
                            'clientes' => $clientes,
                        ]);
    }
}
