<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ServiciosSeeder extends Seeder
{
    public function run()
    {
        // Cargar datos desde el archivo JSON
        $json = File::get(database_path('seeders/servicios.json'));
        $servicios = json_decode($json, true); // Decodificar el JSON en un array

        // Insertar los datos en la tabla 'servicios'
        DB::table('servicios')->insert($servicios);
    }
}
