<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    // Render calendari
    public function index()
    {
        return Inertia::render('Calendario/Index');
    }

    //getEvents
    public function getEvents(Request $request)
{
    $date = $request->query('date');

    $eventsQuery = Event::query();

    if ($date) {
        $eventsQuery->whereDate('start', '=', Carbon::parse($date)->format('Y-m-d'));
    }

    $events = $eventsQuery->get();

    return $events->map(function ($event) {
        return [
            'id'          => $event->id,
            'user_id'     => $event->user_id,
            'title'       => $event->title,
            'fecha'       => $event->fecha,
            'start'       => $event->start,
            'end'         => $event->end,
            'tipo'        => $event->tipo,
            'descripcion' => $event->descripcion,
            'comentario'  => $event->comentario,
            'precio'      => $event->precio,
        ];
    });
}

    // Create view render
    public function create()
    {
        $userName = Auth::user()->name;
        return Inertia::render('Eventos/Create', [
            'userName' => $userName,
        ]);

    }

    // store
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'fecha' => 'required|date_format:d-m-Y',
        'start' => 'required|date',
        'end' => 'nullable|date',
        'tipo' => 'required|string',
        'descripcion' => 'nullable|string',
        'comentario' => 'nullable|string',
        'precio' => 'nullable|numeric',
    ]);

    $fecha = Carbon::createFromFormat('d-m-Y', $request->fecha)->format('Y-m-d');

    $event = Event::create([
        'user_id'    => Auth::user()->id,
        'title'      => $request->title,
        'fecha'      => $fecha,
        'start'      => $request->start,
        'end'        => $request->end,
        'tipo'       => $request->tipo,
        'descripcion'=> $request->descripcion,
        'comentario' => $request->comentario,
        'precio'     => $request->precio,
    ]);

    return redirect()->route('clients')->with('success', 'Cita reservada');
}
}


