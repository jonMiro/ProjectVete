<?php


// AltaController.php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Servicio;
use App\Models\Consulta;


class AltaController extends Controller
{
    public function index()
    {

        $veterinarios = User::where('tipo', 'veterinario')->get();
        $auxiliares = User::where('tipo', 'auxiliar')->get();
        $clientes = User::where('tipo', 'cliente')->get();
        $users = User::all();

        return Inertia::render('Alta/Index', [
            'veterinarios' => $veterinarios,
            'auxiliares' => $auxiliares,
            'clientes' => $clientes,
            'users' => $users,
            'animales' => Animal::with('user')->get(),
        ]);
    }

    //CREAR USER
    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'apellidos'  => 'nullable|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'telefono'   => 'nullable|string|max:20',
            'direccion'  => 'nullable|string|max:255',
            'tipo'       => 'required|in:cliente,veterinario,auxiliar',
            'is_worker'  => 'nullable|boolean',
            'password'   => 'nullable|string|min:8',
        ]);

        // predeterminada per a que la cambie el usuari despres
        $password = $validated['password'] ?? '12345678';

        $user = User::create([
            'name'       => $validated['name'],
            'apellidos'  => $validated['apellidos'],
            'email'      => $validated['email'],
            'telefono'   => $validated['telefono'],
            'direccion'  => $validated['direccion'],
            'tipo'       => $validated['tipo'],
            'is_worker'  => $validated['is_worker'] ?? false,
            'password'   => bcrypt($password),
        ]);

        return redirect()->route('alta.index')->with('success', 'Usuario creado con éxito');
    }


    //CREAR ANIMAL
    public function storeAnimal(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'raza' => 'required|string|max:255',
            'sexo' => 'nullable|string|max:255',
            'fechaNacimiento' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'observaciones' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // imatge
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('public/imagenes_animales');
            $data['imagen'] = basename($path);
        }

        $animal = Animal::create($data);

        return response()->json(['message' => 'Animal registrado con éxito', 'animal' => $animal], 201);
    }

    public function storeServicio(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'animal_id' => 'required|exists:animales,id',
        'tipo_servicio' => 'required|string',
        'descripcion' => 'nullable|string',
        'duracion' => 'required|integer',
        'precio' => 'required|numeric',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i',
    ]);

    Servicio::create($validated);

    return redirect()->route('alta.index')->with('success', 'Servicio creado correctamente.');
}


//CREAR CONSULTA
public function storeConsulta(Request $request)
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

    return redirect()->route('alta.index')->with('success', 'Consulta creada correctamente.');
}

}
