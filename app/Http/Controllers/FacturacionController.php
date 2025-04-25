<?php

// app/Http/Controllers/FacturacionController.php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Consulta;
use Inertia\Inertia;

class FacturacionController extends Controller
{
    public function index()
    {
        // Cargar los servicios y consultas con las relaciones necesarias
        $servicios = Servicio::with(['user', 'animal.user'])->get();
        $consultas = Consulta::with(['user', 'animal.user'])->get();

        // Calcular los totales
        $totalServicios = $servicios->sum('precio');
        $totalConsultas = $consultas->sum('precio');
        $totalGeneral = $totalServicios + $totalConsultas;

        return Inertia::render('Facturacion/Index', [
            'servicios' => $servicios,
            'consultas' => $consultas,
            'totalServicios' => $totalServicios,
            'totalConsultas' => $totalConsultas,
            'totalGeneral' => $totalGeneral,
        ]);
    }
}
