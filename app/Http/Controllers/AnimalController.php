<?php
// app/Http/Controllers/AnimalController.php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    Log::info('Iniciando proceso de creación del animal'); // Esto debería aparecer en los logs

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

    Log::info('Datos recibidos en el store:', $data);  // Loguea los datos recibidos

    // Crear el animal en la base de datos
    $animal = Animal::create($data);

    if ($request->hasFile('imagen')) {

        $nombre = $animal->nombre. '.' .$request->file('imagen')->getClientOriginalExtension();
        $img = $request->file('imagen')->storeAs('public/img',$nombre);
        $animal->imagen = 'storage/img/'.$nombre;
        $animal->save();

    }


    Log::info('Animal creado exitosamente');  // Loguea cuando el animal es creado

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
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login'); // Redirige al login si el usuario no está autenticado
        }

        // Obtener el primer animal asociado al usuario, cargando la relación 'user'
        $animal = Animal::with('user')->where('user_id', $user->id)->first();

        if (!$animal) {
            return redirect()->route('animales.create')->with('message', 'Aún no tienes animales asociados.');
        }

        return Inertia::render('Animales/ShowForUser', [
            'animal' => $animal, // Pasamos el animal a la vista
        ]);
    }

}
