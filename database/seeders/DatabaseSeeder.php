<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Veterinario;
use App\Models\Auxiliar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Creamos un usuario primero
        $user = new User([
            'name' => 'Ana López',
            'email' => 'ana.auxiliar@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->save();  // Guardamos el usuario

        // Ahora creamos un auxiliar y lo asociamos al usuario
        $auxiliar = Auxiliar::create([
            'nombre' => 'Ana',
            'apellidos' => 'López',
            'telefono' => '123456789',
            'direccion' => 'Calle Luna 123',
            'correo' => 'ana.auxiliar@example.com',
            'userable_type' => User::class,
            'userable_id' => $user->id, // Asignamos el ID del usuario
        ]);
         // Crear un veterinario 1
         $userVet1 = new User([
            'name' => 'Dr. Juan Pérez',
            'email' => 'juan.veterinario1@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $userVet1->save();

        // Crear el veterinario 1
        $veterinario1 = Veterinario::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'telefono' => '666123456',
            'direccion' => 'Calle Veterinario 1',
            'correo' => 'juan.veterinario1@example.com',
            'userable_type' => User::class,
            'userable_id' => $userVet1->id,
        ]);

        // Crear un veterinario 2
        $userVet2 = new User([
            'name' => 'Dr. Laura González',
            'email' => 'laura.veterinario2@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $userVet2->save();

        // Crear el veterinario 2
        $veterinario2 = Veterinario::create([
            'nombre' => 'Laura',
            'apellidos' => 'González',
            'telefono' => '666654321',
            'direccion' => 'Calle Veterinario 2',
            'correo' => 'laura.veterinario2@example.com',
            'userable_type' => User::class,
            'userable_id' => $userVet2->id,
        ]);

        // Crear un cliente 1
        $userClient1 = new User([
            'name' => 'Carlos Díaz',
            'email' => 'carlos.cliente1@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $userClient1->save();

        // Crear el cliente 1
        $cliente1 = Cliente::create([
            'nombre' => 'Carlos',
            'apellidos' => 'Díaz',
            'telefono' => '600789123',
            'direccion' => 'Calle Cliente 1',
            'correo' => 'carlos.cliente1@example.com',
            'userable_type' => User::class,
            'userable_id' => $userClient1->id,
        ]);

        // Crear un cliente 2
        $userClient2 = new User([
            'name' => 'Marta Ruiz',
            'email' => 'marta.cliente2@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $userClient2->save();

        // Crear el cliente 2
        $cliente2 = Cliente::create([
            'nombre' => 'Marta',
            'apellidos' => 'Ruiz',
            'telefono' => '600321654',
            'direccion' => 'Calle Cliente 2',
            'correo' => 'marta.cliente2@example.com',
            'userable_type' => User::class,
            'userable_id' => $userClient2->id,
        ]);
    }
}


