<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ConsultasSeeder extends Seeder
{
    public function run()
    {
        // Cargar datos desde el archivo JSON
        $json = File::get(database_path('seeders/consultas.json'));
        $consultas = json_decode($json, true); // Decodificar el JSON en un array

        // Insertar los datos en la tabla 'servicios'
        DB::table('consultas')->insert($consultas);
    }
}
