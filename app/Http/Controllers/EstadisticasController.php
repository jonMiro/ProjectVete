<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Animal;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class EstadisticasController extends Controller
{
    public function index()
    {
        $consultasCount = Consulta::count();
        $serviciosCount = Servicio::count();
        $animalesCount = Animal::count();
        $usuariosCount = User::count();

        $animalesPorTipo = $this->getAnimalesPorTipo();
        $facturacion = $this->getFacturacionMensual();
        $usuariosPorTipo = $this->getUsuariosPorTipo();

        return Inertia::render('Estadisticas/Index', [
            'consultasCount' => $consultasCount,
            'serviciosCount' => $serviciosCount,
            'animalesCount' => $animalesCount,
            'usuariosCount' => $usuariosCount,
            'animalesPorTipo' => $animalesPorTipo,
            'facturacionMensual' => $facturacion['mensual'], // Array mensual
            'facturacionTotal' => $facturacion['total'],     // Array total
            'usuariosPorTipo' => $usuariosPorTipo,
        ]);
    }

    private function getAnimalesPorTipo()
    {
        return Consulta::join('animales', 'consultas.animal_id', '=', 'animales.id')
            ->selectRaw('animales.tipo, COUNT(*) as total')
            ->groupBy('animales.tipo')
            ->get();
    }

    private function getFacturacionMensual()
    {
        // Facturació consulta
        $consultas = Consulta::selectRaw('YEAR(fecha) as year, MONTH(fecha) as month, SUM(precio) as total')
            ->groupBy('year', 'month')
            ->get()
            ->mapWithKeys(function ($item) {
                $date = Carbon::createFromDate($item->year, $item->month, 1)->format('Y-m');
                return [$date => ['consulta' => $item->total, 'servicio' => 0]];
            });

        // Facturació servicis
        $servicios = Servicio::selectRaw('YEAR(fecha) as year, MONTH(fecha) as month, SUM(precio) as total')
            ->groupBy('year', 'month')
            ->get()
            ->mapWithKeys(function ($item) {
                $date = Carbon::createFromDate($item->year, $item->month, 1)->format('Y-m');
                return [$date => ['consulta' => 0, 'servicio' => $item->total]];
            });

        $fechas = $consultas->keys()->merge($servicios->keys())->unique()->sort();

        // Combinem facturacio mensual a partir de la fecha
        $facturacionMensual = $fechas->map(function ($fecha) use ($consultas, $servicios) {
            return [
                'date' => $fecha,
                'consulta' => $consultas[$fecha]['consulta'] ?? 0,
                'servicio' => $servicios[$fecha]['servicio'] ?? 0,
            ];
        })->values();

        // Calcular total
        $totalFacturacion = $facturacionMensual->sum(fn ($item) => $item['consulta'] + $item['servicio']);

        return [
            'mensual' => $facturacionMensual,
            'total' => $totalFacturacion,
        ];
    }

    private function getUsuariosPorTipo()
    {
        return User::selectRaw('tipo, COUNT(*) as total')
            ->groupBy('tipo')
            ->get();
    }
}
