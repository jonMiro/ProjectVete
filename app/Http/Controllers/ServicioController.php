<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::with(['user', 'animal'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Servicios/Index', [
            'servicios' => $servicios,
        ]);
    }

    public function show($id)
    {
        $servicio = Servicio::with(['user', 'animal'])->findOrFail($id);

        return Inertia::render('Servicios/Show', [
            'servicio' => $servicio,
        ]);
    }

    public function create()
    {
        $auxiliares = User::where('tipo', 'auxiliar')->get();


        $animales = Animal::with('user')->get();

        return Inertia::render('Servicios/Create', [
            'auxiliares' => $auxiliares,
            'animales' => $animales,
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'required|exists:animales,id',
            'tipo_servicio' => 'required|string',
            'descripcion' => 'nullable|string',
            'duracion' => 'required|integer',
            'precio' => 'required|numeric',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        Servicio::create($validated);

        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente.');
    }

    public function edit(Servicio $servicio)
    {
        $users = User::all();
        $animales = Animal::all();

        return Inertia::render('Servicios/Edit', [
            'servicio' => $servicio,
            'users' => $users,
            'animales' => $animales,
        ]);
    }

    public function update(Request $request, Servicio $servicio)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'animal_id' => 'required|exists:animales,id',
            'tipo_servicio' => 'required|string',
            'descripcion' => 'nullable|string',
            'duracion' => 'required|integer',
            'precio' => 'required|numeric',
            'fecha' => 'nullable|date',
        ]);

        $servicio->update($validated);

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente.');
    }
}
