<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        

        $this->call([
            UserSeeder::class,
            AnimalsSeeder::class,
            ConsultasSeeder::class,
            ServiciosSeeder::class,
            EventSeeder::class,
            PostsSeeder::class,
        ]);
    }
}
