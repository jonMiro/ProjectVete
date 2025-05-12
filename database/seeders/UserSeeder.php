<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Veterinario 1
        User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'vete1@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Pérez',
            'telefono' => '666123456',
            'direccion' => 'Calle LaFuente 1, Agullent',
            'tipo' => 'veterinario',
            'is_worker' => true,
        ]);

        // Veterinario 2
        User::create([
            'name' => 'Dr. Laura González',
            'email' => 'vete2@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'González',
            'telefono' => '666654321',
            'direccion' => 'Calle Rios, Ontinyent',
            'tipo' => 'veterinario',
            'is_worker' => true,
        ]);

        // Auxiliar 1
        User::create([
            'name' => 'Ana López',
            'email' => 'auxiliar1@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Gallardo',
            'telefono' => '687827899',
            'direccion' => 'Calle Luna 123',
            'tipo' => 'auxiliar',
            'is_worker' => true,
        ]);

        // Auxiliar 2
        User::create([
            'name' => 'Juan Cuesta',
            'email' => 'auxiliar2@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Alonso',
            'telefono' => '675898453',
            'direccion' => 'Calle Sol 321',
            'tipo' => 'auxiliar',
            'is_worker' => true,
        ]);

        // Cliente 1
        User::create([
            'name' => 'Carlos Díaz',
            'email' => 'cliente1@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Díaz',
            'telefono' => '600789123',
            'direccion' => 'Calle Ramon y Cajal, 22, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 2
        User::create([
            'name' => 'Marta Ruiz',
            'email' => 'cliente2@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Ruiz',
            'telefono' => '600321654',
            'direccion' => 'Calle Rafael Juan Vidal, 10, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 3
        User::create([
            'name' => 'Lucía Martínez',
            'email' => 'lucia.martinez@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Martínez',
            'telefono' => '611223344',
            'direccion' => 'Avenida Almaig, 15, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 4
        User::create([
            'name' => 'Pedro Torres',
            'email' => 'pedro.torres@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Torres',
            'telefono' => '622334455',
            'direccion' => 'Calle San José, 18, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 5
        User::create([
            'name' => 'Sofía Hernández',
            'email' => 'sofia.hernandez@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Hernández',
            'telefono' => '633445566',
            'direccion' => 'Calle Dos de Mayo, 8, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 6
        User::create([
            'name' => 'David García',
            'email' => 'david.garcia@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'García',
            'telefono' => '644556677',
            'direccion' => 'Calle Cristo, 40, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 7
        User::create([
            'name' => 'Elena Navarro',
            'email' => 'elena.navarro@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Navarro',
            'telefono' => '655667788',
            'direccion' => 'Calle San Antonio, 5, Agullent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 8
        User::create([
            'name' => 'Luis Romero',
            'email' => 'luis.romero@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Romero',
            'telefono' => '666778899',
            'direccion' => 'Camino Viejo de Xàtiva, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 9
        User::create([
            'name' => 'Patricia Mora',
            'email' => 'patricia.mora@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Mora',
            'telefono' => '677889900',
            'direccion' => 'Calle Mayor, 33, Agullent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 10
        User::create([
            'name' => 'Héctor Ferrer',
            'email' => 'hector.ferrer@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Ferrer',
            'telefono' => '688990011',
            'direccion' => 'Calle Del Mar, 12, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);

        // Cliente 11
        User::create([
            'name' => 'Teresa Vidal',
            'email' => 'teresa.vidal@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Vidal',
            'telefono' => '699001122',
            'direccion' => 'Calle Nou d’Octubre, 9, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);


    }
}
