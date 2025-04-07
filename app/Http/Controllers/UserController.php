<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use App\Models\Auxiliar;
use App\Models\Cliente;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Muestra el dashboard de usuarios con veterinarios, auxiliares y clientes.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Obtener los veterinarios, auxiliares y clientes
        $veterinarios = Veterinario::all();
        $auxiliares = Auxiliar::all();
        $clientes = Cliente::all();

        return Inertia::render('Users/Index', [
            'veterinarios' => $veterinarios,
            'auxiliares' => $auxiliares,
            'clientes' => $clientes,
        ]);
    }
}
