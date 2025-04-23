<?php

// app/Http/Controllers/ServicioController.php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{
    // Función index: muestra todos los servicios
    public function index()
    {
        $servicios = Servicio::with(['user', 'animal'])->latest()->get();  // Obtener todos los servicios con sus relaciones

        return Inertia::render('Servicios/Index', [
            'servicios' => $servicios,
        ]);
    }

    // Función show: muestra un solo servicio
    public function show($id)
    {
        $servicio = Servicio::with(['auxiliar', 'animal'])->findOrFail($id);

        return Inertia::render('Servicios/Show', [
            'servicio' => $servicio,
        ]);
    }

    // Función create: muestra el formulario de creación de un servicio
    public function create()
    {
        // Obtener auxiliares y animales disponibles
        $auxiliares = User::all();
        $animales = Animal::all();

        return Inertia::render('Servicios/Create', [
            'auxiliares' => $auxiliares,
            'animales' => $animales,
        ]);
    }

    // Función store: guarda un nuevo servicio
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'user_id' => 'required|exists:auxiliares,id',
            'animal_id' => 'required|exists:animales,id',
            'tipo_servicio' => 'required|string',
            'descripcion' => 'nullable|string',
            'duracion' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        // Crear el nuevo servicio
        Servicio::create($validated);

        return redirect()->route('servicios.index')->with('success', 'Servicio creado correctamente.');
    }

    // Función edit: muestra el formulario de edición de un servicio
    public function edit(Servicio $servicio)
    {
        // Obtener los auxiliares y animales disponibles
        $users = User::all();
        $animales = Animal::all();

        return Inertia::render('Servicios/Edit', [
            'servicio' => $servicio,
            'users' => $users,
            'animales' => $animales,
        ]);
    }

    // Función update: actualiza un servicio
    public function update(Request $request, Servicio $servicio)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'user_id' => 'required|exists:auxiliares,id',
            'animal_id' => 'required|exists:animales,id',
            'tipo_servicio' => 'required|string',
            'descripcion' => 'nullable|string',
            'duracion' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        // Actualizar el servicio
        $servicio->update($validated);

        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado correctamente.');
    }

    // Función destroy: elimina un servicio
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado correctamente.');
    }
}

