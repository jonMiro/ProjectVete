<?php
// app/Http/Controllers/AnimalController.php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animales = Animal::with(['user'])->get(); // Relacionem y portem animal en el user
        return Inertia::render('Animales/Index', [
            'animales' => $animales,
        ]);
    }

    public function show($id)
    {
        $animal = Animal::with(['user'])->findOrFail($id);
        return Inertia::render('Animales/Show', [
            'animal' => $animal,
        ]);
    }

    public function create()
    {
        $users = User::all();

        return Inertia::render('Animales/Create', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'sexo' => 'nullable|string|max:255',
            'fechaNacimiento' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'imagen' => 'nullable|image',
            'observaciones' => 'nullable|string',
        ]);

        Animal::create($data);
        return redirect()->route('animales.index');
    }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);
        $users = User::all();

        return Inertia::render('Animales/Edit', [
            'animal' => $animal,
            'users' => $users,
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
            'user_id' => 'required|exists:users,id',
            'imagen' => 'nullable|image',
            'observaciones' => 'nullable|string',
        ]);

        $animal = Animal::findOrFail($id);
        $animal->update($data);
        return redirect()->route('animales.index');
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return redirect()->route('animales.index')->with('success', 'Animal eliminado');
    }
}
