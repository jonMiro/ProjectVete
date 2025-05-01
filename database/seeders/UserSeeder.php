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
            'apellidos' => 'López',
            'telefono' => '123456789',
            'direccion' => 'Calle Luna 123',
            'tipo' => 'auxiliar',
            'is_worker' => true,
        ]);

        // Auxiliar 2
        User::create([
            'name' => 'Juan',
            'email' => 'auxiliar2@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Cuesta',
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
            'email' => 'marta.cliente2@example.com',
            'password' => Hash::make('12345678'),
            'apellidos' => 'Ruiz',
            'telefono' => '600321654',
            'direccion' => 'Calle Rafael Juan Vidal, 10, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);
    }
}
