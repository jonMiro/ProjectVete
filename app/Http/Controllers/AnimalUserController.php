<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AnimalUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $animales = $user->animales;

        return Inertia::render('AnimalesUser/Index', [
            'animales' => $animales,
        ]);
    }

public function edit($id)
{
    $animal = Animal::findOrFail($id);
    $user = Auth::user();

    $animal = Animal::findOrFail($id);
    return Inertia::render('AnimalesUser/Edit', [
        'animal' => $animal,
        'user'   => $user,
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
            'observaciones' => 'nullable|string',
        ]);

        $animal = Animal::findOrFail($id);
        $animal->update($data);
        return redirect()->route('clients.animales.index');
    }


public function destroy($id)
{
    $animal = Animal::findOrFail($id);
    $animal->delete();
    return redirect()->route('clients.animales.index');
}

public function show($id)
{
    $animal = Animal::findOrFail($id);
    return Inertia::render('AnimalesUser/Show', [
        'animal' => $animal,
    ]);
}

public function create()
{
    $clientes = User::where('tipo', 'cliente')->get();
    $user = Auth::user();

    return Inertia::render('AnimalesUser/Create', [
        'clientes' => $clientes,
        'user' => $user,
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
        'observaciones' => 'nullable|string',
    ]);

    Animal::create($data);

    return redirect()->route('clients.animales.index')->with('success', 'Animal creado correctamente');
}

}

