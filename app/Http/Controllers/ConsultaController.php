<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Cliente;
use App\Models\Animal;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with(['animal', 'veterinario'])->latest()->get();

        return Inertia::render('Consultas/Index', [
            'consultas' => $consultas
        ]);
    }

    public function show($id)
    {
        // Obtener la consulta por ID
        $consulta = Consulta::with(['animal', 'veterinario'])->findOrFail($id);

        // Retornar la vista Inertia con los datos de la consulta
        return Inertia::render('Consultas/Show', [
            'consulta' => $consulta
        ]);
    }



    public function create()
{
    $animales = Animal::with('cliente')->get(); // Carga explícitamente la relación 'cliente'
    $veterinarios = Veterinario::all();
    $clientes = Cliente::all();

    return Inertia::render('Consultas/Create', [
        'animales' => $animales,
        'veterinarios' => $veterinarios,
        'clientes' => $clientes,
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animales,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha' => 'required|date',
            'lugar' => 'nullable|string',
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
        $consulta->load(['animal', 'veterinario']);
        $animales = Animal::all();
        $veterinarios = Veterinario::all();

        return Inertia::render('Consultas/Edit', [
            'consulta' => $consulta,
            'animales' => $animales,
            'veterinarios' => $veterinarios,
        ]);
    }

    public function update(Request $request, Consulta $consulta)
    {
        $validated = $request->validate([
            'animal_id' => 'required|exists:animales,id',
            'veterinario_id' => 'required|exists:veterinarios,id',
            'fecha' => 'required|date',
            'lugar' => 'nullable|string',
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

        $consulta->update($validated);

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente.');
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada correctamente.');
    }
}

