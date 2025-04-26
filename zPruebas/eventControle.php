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
    // Render calendario
    public function index()
    {
        return Inertia::render('Calendario/Index');
    }

    // Obtener todos los eventos
    public function getEvents()
    {
        // Obtenemos eventos y los transformamos
        return Event::all()->map(function ($event) {
            return [
                'id'         => $event->id,
                'user_id'    => $event->user_id,
                'title'      => $event->title,
                'fecha'      => $event->fecha,
                'start'      => $event->start,
                'end'        => $event->end,
                'tipo'       => $event->tipo,
                'descripcion'=> $event->descripcion,
                'comentario' => $event->comentario,
                'precio'     => $event->precio,
            ];
        });
    }

    // Crear un nuevo evento
    public function create()
    {
        return Inertia::render('Eventos/Create');

    }

    // Almacenar un nuevo evento
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'fecha' => 'required|date',
            'start' => 'required|date',
            'end' => 'required|date',
            'tipo' => 'required|string',
            'descripcion' => 'nullable|string',
            'comentario' => 'nullable|string',
            'precio' => 'nullable|numeric',
        ]);

        // Crear el evento asignando al usuario autenticado
        $event = Event::create([
            'user_id'    => Auth::user()->id,
            'title'      => $request->title,
            'fecha'      => $request->fecha,
            'start'      => $request->start,
            'end'        => $request->end,
            'tipo'       => $request->tipo,
            'descripcion'=> $request->descripcion,
            'comentario' => $request->comentario,
            'precio'     => $request->precio,
        ]);

        return redirect()->route('clients')->with('success', 'Servicio contratado con éxito');
    }

}
