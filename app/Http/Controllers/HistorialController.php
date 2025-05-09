<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        $user = Auth::user();
        $hoy = Carbon::now();

        // a partir de la id del user auth traem el animal
        $animalIds = DB::table('animales')
            ->where('user_id', $user->id)
            ->pluck('id');

        // consultes asociades al animal
        $consultas = Consulta::whereIn('animal_id', $animalIds)
            ->with('animal')
            ->get();

        //Servicis asociats al animal
        $servicios = Servicio::whereIn('animal_id', $animalIds)
            ->with('animal')
            ->get();

        // Events de user
        $eventos = Event::where('user_id', $user->id)
            ->whereDate('fecha', '>=', $hoy)
            ->whereNotIn('tipo', ['consulta', 'servicio'])
            ->get();

        return Inertia::render('Historial/Index', [
            'consultas' => $consultas,
            'servicios' => $servicios,
            'eventos' => $eventos,
        ]);
    }

    public function showConsulta($id)
    {
        $consulta = Consulta::with(['user', 'animal'])->findOrFail($id);

        return Inertia::render('Historial/ConsultaShow', [
            'consulta' => $consulta,
        ]);
    }

    public function showServicio($id)
    {
        $servicio = Servicio::with(['user', 'animal'])->findOrFail($id);

        return Inertia::render('Historial/ServicioShow', [
            'servicio' => $servicio,
        ]);
    }

    public function showEvento($id)
    {
        $evento = Event::with('user')->findOrFail($id);

        return Inertia::render('Historial/EventoShow', [
            'evento' => $evento,
        ]);
    }
}
