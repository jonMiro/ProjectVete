<?php


namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'user_id' => 5,
            'title' => 'Peluquería Canina',
            'fecha'  => '2025-04-28',
            'start'  => '2025-04-28 10:00:00',
            'end'    => '2025-04-28 10:30:00',
            'tipo' => 'peluqueria',
            'descripcion' => 'Peluquería para perro mediano. Duración 1 hora.',
            'comentario' => 'Cliente puntual.',
            'precio' => 30.00,
        ]);

        Event::create([
            'user_id' => 6,
            'title' => 'Consulta Veterinaria',
            'fecha'  => '2025-04-25',
            'start'  => '2025-04-25 18:00:00',
            'end'    => null,
            'tipo' => 'cita veterinaria',
            'descripcion' => 'Consulta general. Duración aproximada 30 minutos.',
            'comentario' => 'Revisar vacunas.',
            'precio' => null, // No se sabe hasta realizarse
        ]);

        Event::create([
            'user_id' => 5,
            'title' => 'Vacunación',
            'fecha'  => '2025-04-26',
            'start'  => '2025-04-26 14:00:00',
            'end'    => '2025-04-26 15:30:00',
            'tipo' => 'vacunación',
            'descripcion' => 'Vacuna anual. Duración 15 minutos.',
            'comentario' => 'Traer cartilla.',
            'precio' => 20.00,
        ]);
    }
}
