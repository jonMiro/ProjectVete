<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AnimalsSeeder extends Seeder
{
    public function run()
    {
        // Cargar datos desde el archivo JSON
        $json = File::get(database_path('seeders/animales.json'));
        $animales = json_decode($json, true); // Decodificar el 
        // Insertar los datos en la tabla 'animales'
        DB::table('animales')->insert($animales);
    }
}
