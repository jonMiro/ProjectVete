<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with(['animal', 'user'])->latest()->get();

        return Inertia::render('Consultas/Index', [
            'consultas' => $consultas
        ]);
    }

    public function show($id)
    {
        // Obtener la consulta por ID
        $consulta = Consulta::with(['animal', 'user'])->findOrFail($id);

        // Retornar la vista Inertia con los datos de la consulta
        return Inertia::render('Consultas/Show', [
            'consulta' => $consulta
        ]);
    }



    public function create()
{
    $animales = Animal::with('user')->get(); // Carga explícitamente la relación 'cliente'
    $users = User::all();


    return Inertia::render('Consultas/Create', [
        'animales' => $animales,
        'users' => $users,

    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animales,id',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'lugar' => 'nullable|string',
            'precio' => 'required|numeric',
            'peso' => 'nullable|numeric',
            'tipo_animal' => 'nullable|string',
            'raza' => 'nullable|string',
            'motivo' => 'required|string',
            'anamnesis' => 'nullable|string',
            'examen_fisico' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        Consulta::create($validated);

        return redirect()->route('consultas.index')->with('success', 'Consulta creada correctamente.');
    }

    public function edit(Consulta $consulta)
    {
        $consulta->load(['animal', 'user']);
        $animales = Animal::all();
        $users = User::all();

        return Inertia::render('Consultas/Edit', [
            'consulta' => $consulta,
            'animales' => $animales,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Consulta $consulta)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animales,id',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'lugar' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'precio' => 'required|numeric',
            'tipo_animal' => 'nullable|string',
            'raza' => 'nullable|string',
            'motivo' => 'required|string',
            'anamnesis' => 'nullable|string',
            'examen_fisico' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $consulta->update($validated);

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente.');
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada correctamente.');
    }
}

