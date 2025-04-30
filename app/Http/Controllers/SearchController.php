<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->get('search', '');

        $veterinarios = User::where('tipo', 'veterinario')
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                      ->orWhere('apellidos', 'like', "%{$searchQuery}%");
            })
            ->get();

        $auxiliares = User::where('tipo', 'auxiliar')
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                      ->orWhere('apellidos', 'like', "%{$searchQuery}%");
            })
            ->get();

        $clientes = User::where('tipo', 'cliente')
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', "%{$searchQuery}%")
                      ->orWhere('apellidos', 'like', "%{$searchQuery}%");
            })
            ->get();

        $animales = Animal::where('nombre', 'like', "%{$searchQuery}%")->get();

        return Inertia::render('Search/Index', [
            'veterinarios' => $veterinarios,
            'auxiliares' => $auxiliares,
            'clientes' => $clientes,
            'animales' => $animales,
            'search' => $searchQuery,
        ]);
    }
}
