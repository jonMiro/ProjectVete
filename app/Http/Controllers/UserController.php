<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use Inertia\Inertia;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        // Filtrar usuarios por tipo
        $veterinarios = User::where('tipo', 'veterinario')->get();
        $auxiliares   = User::where('tipo', 'auxiliar')->get();
        $clientes     = User::where('tipo', 'cliente')->get();


        $animales = Animal::with('user')->get();

        return Inertia::render('Users/Index', [
            'veterinarios' => $veterinarios,
            'auxiliares'   => $auxiliares,
            'clientes'     => $clientes,
            'animales'     => $animales,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return Inertia::render('Users/Edit', [
        'user' => $user,
    ]);
}

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'apellidos'  => 'nullable|string|max:255',
        'email'      => 'required|email|unique:users,email,' . $user->id,
        'telefono'   => 'nullable|string|max:20',
        'direccion'  => 'nullable|string|max:255',
        'tipo'       => 'required|in:cliente,veterinario,auxiliar',
        'is_worker'  => 'boolean',
        // 'password' puede ser opcional,
    ]);

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'Usuario editado');}

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado');    }
}
