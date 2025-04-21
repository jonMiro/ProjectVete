<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Animal;
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

        // Crear un veterinario 1
        $userVet1 = new User([
            'name' => 'Dr. Juan Pérez',
            'email' => 'vete1@example.com',
            'password' => bcrypt('12345678'),
            'apellidos' => 'Pérez',
            'telefono' => '666123456',
            'direccion' => 'Calle LaFuente 1, Agullent',
            'tipo' => 'veterinario',
            'is_worker' => true,
        ]);
        $userVet1->save();

        // Crear un veterinario 2
        $userVet2 = new User([
            'name' => 'Dr. Laura González',
            'email' => 'vete2@example.com',
            'password' => bcrypt('12345678'),
            'apellidos' => 'González',
            'telefono' => '666654321',
            'direccion' => 'Calle Rios, Ontinyent',
            'tipo' => 'veterinario',
            'is_worker' => true,
        ]);
        $userVet2->save();
         // Crear un auxiliar
         $userAux = new User([
            'name' => 'Ana López',
            'email' => 'auxiliar1@example.com',
            'password' => bcrypt('12345678'),
            'apellidos' => 'López',
            'telefono' => '123456789',
            'direccion' => 'Calle Luna 123',
            'tipo' => 'auxiliar',
            'is_worker' => true,
        ]);
        $userAux->save();
         // Crear un auxiliar
         $userAux = new User([
            'name' => 'Juan',
            'email' => 'auxiliar2@example.com',
            'password' => bcrypt('12345678'),
            'apellidos' => 'Cuesta',
            'telefono' => '675898453',
            'direccion' => 'Calle Sol 321',
            'tipo' => 'auxiliar',
            'is_worker' => true,
        ]);
        $userAux->save();

        // Crear un cliente 1
        $userClient1 = new User([
            'name' => 'Carlos Díaz',
            'email' => 'cliente1@example.com',
            'password' => bcrypt('12345678'),
            'apellidos' => 'Díaz',
            'telefono' => '600789123',
            'direccion' => 'Calle Ramon y Cajal, 22, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);
        $userClient1->save();

        // Crear un cliente 2
        $userClient2 = new User([
            'name' => 'Marta Ruiz',
            'email' => 'marta.cliente2@example.com',
            'password' => bcrypt('12345678'),
            'apellidos' => 'Ruiz',
            'telefono' => '600321654',
            'direccion' => 'Calle Rafael Juan Vidal, 10, Ontinyent',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);
        $userClient2->save();

    }
}
