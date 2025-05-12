<?php
// app/Http/Controllers/AnimalController.php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Event;


class AnimalController extends Controller
{
    public function index()
    {
        $animales = Animal::with(['user'])->get();
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
    Log::info('Iniciando proceso de creación del animal');
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

    Log::info('Datos recibidos en el store:', $data);

    $animal = Animal::create($data);

    if ($request->hasFile('imagen')) {

        $nombre = $animal->nombre. '.' .$request->file('imagen')->getClientOriginalExtension();
        $img = $request->file('imagen')->storeAs('public/img',$nombre);
        $animal->imagen = 'storage/img/'.$nombre;
        $animal->save();

    }


    Log::info('Animal creado exitosamente');

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

    public function showForUser()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $animal = Animal::with('user')->where('user_id', $user->id)->first();

        if (!$animal) {
            return redirect()->route('animales.create')->with('message', 'Aún no tienes animales asociados.');
        }

        return Inertia::render('Animales/ShowForUser', [
            'animal' => $animal,
        ]);
    }

    public function historial(Animal $animal)
{
    $animal->load([
        'consultas.user',
        'servicios.user'
    ]);


    return Inertia::render('Animales/Historial', [
        'animal' => $animal,
        'consultas' => $animal->consultas,
        'servicios' => $animal->servicios,
    ]);
}


}
