<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use App\Models\Animal;
use App\Models\Servicio;  // Asegúrate de tener el modelo Servicio importado
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $searchQuery = $request->get('search', ''); // Pillem el valor del search (label del form)

        // FILTREM EN USUARIOS, ANIMALES, SERVICIOS, CLIENTES
        $clientes = Cliente::where('nombre', 'like', "%{$searchQuery}%")
                            ->orWhere('apellidos', 'like', "%{$searchQuery}%")
                            ->get();

        $animales = Animal::where('nombre', 'like', "%{$searchQuery}%")
                            ->get();

        $servicios = Servicio::where('tipo_servicio', 'like', "%{$searchQuery}%")
                            ->get();

        // Pasar los datos como props a la vista
        return Inertia::render('Search/Index', [
            'clientes' => $clientes,
            'animales' => $animales,
            'servicios' => $servicios,
            'search' => $searchQuery,
        ]);
    }
}
