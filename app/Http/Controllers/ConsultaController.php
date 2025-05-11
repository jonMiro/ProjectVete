<?php
namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->input('order', 'desc');

        $consultas = Consulta::with(['animal', 'user'])
            ->orderBy('fecha', $order)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Consultas/Index', [
            'consultas' => $consultas,
            'currentOrder' => $order,  
        ]);
    }

    public function show($id)
    {
        $consulta = Consulta::with(['animal', 'user'])->findOrFail($id);

        return Inertia::render('Consultas/Show', [
            'consulta' => $consulta
        ]);
    }

    public function create()
    {
        $animales = Animal::with('user')->get();
        $users = User::where('tipo', 'veterinario')->get();  // Filtrem veterinaris

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
            'hora' => 'required|date_format:H:i',
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
        //Autoasignem hora
        if (!$consulta->hora) {
            $consulta->hora = now()->format('H:i');
        }

        $animales = Animal::all();
        $users = User::where('tipo', 'veterinario')->get();

        return Inertia::render('Consultas/Edit', [
            'consulta' => $consulta,
            'animales' => $animales,
            'users' => $users,
        ]);
    }

    public function update(Request $request, Consulta $consulta)
    {
        // El problema es que si no cambiava l' hora no hem deixava fer el update, hora-nullable
        $validated = $request->validate([
            'animal_id' => 'required|exists:animales,id',
            'user_id' => 'required|exists:users,id',
            'fecha' => 'nullable|date',
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

        // Asignar hora
        $consulta->hora = now()->format('H:i');


        $consulta->update($validated);

        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente.');
    }

    public function destroy(Consulta $consulta)
    {
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada correctamente.');
    }
}
