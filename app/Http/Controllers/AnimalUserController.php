<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AnimalUserController extends Controller
{
    // Muestra los animales del usuario
    public function index()
    {
        $user = Auth::user(); // Obtén el usuario autenticado
        $animales = $user->animales; // Obtén los animales asociados al usuario

        return Inertia::render('AnimalesUser/Index', [
            'animales' => $animales,
        ]);
    }

// Muestra el formulario de edición de un animal
public function edit($id)
{
    $animal = Animal::findOrFail($id);
    $user = Auth::user();

    $animal = Animal::findOrFail($id); // Encuentra el animal por ID
    return Inertia::render('AnimalesUser/Edit', [
        'animal' => $animal,
        'user'   => $user,
    ]);
}

// Actualiza los datos de un animal
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
        return redirect()->route('clients.animales.index');
    }


// Elimina un animal
public function destroy($id)
{
    $animal = Animal::findOrFail($id);
    $animal->delete(); // Elimina el animal

    return redirect()->route('clients.animales.index'); // Redirige después de eliminar
}
}

