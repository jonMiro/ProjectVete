<?php


namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Consulta;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class HistorialController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $hoy = Carbon::now();

        // Eventos genéricos futuros (no consulta ni servicio)
        $otrosEventos = Event::where('user_id', $userId)
            ->whereDate('fecha', '>=', $hoy)
            ->whereNotIn('tipo', ['consulta', 'servicio'])
            ->get();

        // Consultas futuras del usuario
        $consultas = Consulta::where('user_id', $userId)
            ->with(['animal'])
            ->get();

        // Servicios futuros del usuario
        $servicios = Servicio::where('user_id', $userId)
            ->with(['animal'])
            ->get();

            return Inertia::render('Historial/Index', [
            'otrosEventos' => $otrosEventos,
            'consultas' => $consultas,
            'servicios' => $servicios,
        ]);
    }
    // app/Http/Controllers/HistorialController.php
    public function showConsulta($id)
    {
        $consulta = Consulta::with(['user', 'animal'])->findOrFail($id);

        return Inertia::render('Historial/ConsultaShow', [
            'consulta' => $consulta,
        ]);
    }

    // Mostrar detalles del servicio
    public function showServicio($id)
    {
        $servicio = Servicio::with(['user', 'animal'])->findOrFail($id);

        return Inertia::render('Historial/ServicioShow', [
            'servicio' => $servicio,
        ]);
    }
    // Mostrar detalles del evento

    public function showEvento($id)
    {
        $evento = Event::with(['user'])->findOrFail($id);

        return Inertia::render('Historial/EventoShow', [
            'evento' => $evento,
        ]);
    }

    public function destroyConsulta($id)
{
    $consulta = Consulta::findOrFail($id);
    $consulta->delete();

    return redirect()->route('clients.historial.index')->with('success', 'Consulta eliminada correctamente.');
}
public function destroyServicio($id)
{
    $servicio = Servicio::findOrFail($id);
    $servicio->delete();

    return redirect()->route('clients.historial.index')->with('success', 'Servicio eliminada correctamente.');
}
public function destroyEvento($id)
{
    $evento = Event::findOrFail($id);
    $evento->delete();

    return redirect()->route('clients.historial.index')->with('success', 'Evento eliminada correctamente.');
}

}

