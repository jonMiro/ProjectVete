<?php
// app/Http/Controllers/AnimalController.php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Cliente;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animales = Animal::with(['cliente'])->get(); // Relación con cliente (no es necesario usuario)
        return Inertia::render('Animales/Index', [
            'animales' => $animales,
        ]);
    }

    public function show($id)
    {
        $animal = Animal::with(['cliente'])->findOrFail($id); // Trae el animal con su relación cliente
        return Inertia::render('Animales/Show', [
            'animal' => $animal,
        ]);
    }

    public function create()
    {
        $clientes = Cliente::all(); // Traemos todos los clientes

        return Inertia::render('Animales/Create', [
            'clientes' => $clientes,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'sexo' => 'nullable|string|max:255', // El sexo es opcional
            'fechaNacimiento' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id', // Validación para el cliente
            'imagen' => 'nullable|image', // Validación para la imagen (opcional)
            'observaciones' => 'nullable|string',
        ]);

        Animal::create($data); // Guardamos el animal
        return redirect()->route('animales.index');
    }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        $clientes = Cliente::all();

        return Inertia::render('Animales/Edit', [
            'animal' => $animal,
            'clientes' => $clientes,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'sexo' => 'nullable|string|max:255',
            'fechaNacimiento' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id',
            'imagen' => 'nullable|image',
            'observaciones' => 'nullable|string',
        ]);

        $animal = Animal::findOrFail($id);
        $animal->update($data); // Actualizamos el animal con los nuevos datos
        return redirect()->route('animales.index');
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete(); // Eliminamos el animal

        return redirect()->route('animales.index')->with('success', 'Animal eliminado');
    }
}
