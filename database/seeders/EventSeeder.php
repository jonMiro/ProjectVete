<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run()
    {
        Event::create([
            'user_id' => 5,
            'title' => 'Peluquería Canina',
            'fecha'  => '2025-05-20',
            'start'  => '2025-05-20 09:00:00',
            'end'    => '2025-05-20 10:00:00',
            'tipo' => 'peluqueria',
            'descripcion' => 'Peluquería para perro grande. Duración 1 hora.',
            'comentario' => 'Cliente habitual. Cortar pelo y limpieza de oídos.',
            'precio' => 35.00,
        ]);

        Event::create([
            'user_id' => 6,
            'title' => 'Cita Veterinaria',
            'fecha'  => '2025-05-21',
            'start'  => '2025-05-21 10:30:00',
            'end'    => '2025-05-21 11:00:00',
            'tipo' => 'cita veterinaria',
            'descripcion' => 'Consulta para chequeo general.',
            'comentario' => 'Revisar síntomas de alergia.',
            'precio' => 25.00,
        ]);

        Event::create([
            'user_id' => 5,
            'title' => 'Pedicura Canina',
            'fecha'  => '2025-05-22',
            'start'  => '2025-05-22 11:00:00',
            'end'    => '2025-05-22 12:00:00',
            'tipo' => 'pedicura',
            'descripcion' => 'Corte de uñas y cuidado de patas para perro mediano.',
            'comentario' => 'Asegurarse de que las patas estén bien cuidadas.',
            'precio' => 15.00,
        ]);

        Event::create([
            'user_id' => 6,
            'title' => 'Lavado Canino',
            'fecha'  => '2025-05-22',
            'start'  => '2025-05-22 13:00:00',
            'end'    => '2025-05-22 14:00:00',
            'tipo' => 'lavado',
            'descripcion' => 'Baño completo para perro pequeño.',
            'comentario' => 'Usar champú para piel sensible.',
            'precio' => 20.00,
        ]);
         // Nuevos eventos entre el 15 y el 31 de mayo

        // Usuario 5
        Event::create([
            'user_id' => 5,
            'title' => 'Peluquería Canina',
            'fecha'  => '2025-05-16',
            'start'  => '2025-05-16 10:00:00',
            'end'    => '2025-05-16 11:00:00',
            'tipo' => 'peluqueria',
            'descripcion' => 'Peluquería para perro pequeño.',
            'comentario' => 'Corte de pelo para perro de raza pequeña.',
            'precio' => 25.00,
        ]);

        Event::create([
            'user_id' => 5,
            'title' => 'Cita Veterinaria',
            'fecha'  => '2025-05-18',
            'start'  => '2025-05-18 14:00:00',
            'end'    => '2025-05-18 14:30:00',
            'tipo' => 'cita veterinaria',
            'descripcion' => 'Revisión dental.',
            'comentario' => 'Revisar dientes y encías.',
            'precio' => 40.00,
        ]);

        // Usuario 6
        Event::create([
            'user_id' => 6,
            'title' => 'Vacunación',
            'fecha'  => '2025-05-17',
            'start'  => '2025-05-17 09:00:00',
            'end'    => '2025-05-17 09:15:00',
            'tipo' => 'vacunacion',
            'descripcion' => 'Vacuna anual para perro adulto.',
            'comentario' => 'Cliente nuevo.',
            'precio' => 15.00,
        ]);

        Event::create([
            'user_id' => 6,
            'title' => 'Pedicura Canina',
            'fecha'  => '2025-05-19',
            'start'  => '2025-05-19 11:30:00',
            'end'    => '2025-05-19 12:30:00',
            'tipo' => 'pedicura',
            'descripcion' => 'Corte de uñas y cuidado de patas.',
            'comentario' => 'Asegurarse de que el perro no tenga heridas.',
            'precio' => 12.00,
        ]);

        // Usuario 7
        Event::create([
            'user_id' => 7,
            'title' => 'Cita Veterinaria',
            'fecha'  => '2025-05-20',
            'start'  => '2025-05-20 13:00:00',
            'end'    => '2025-05-20 13:30:00',
            'tipo' => 'cita veterinaria',
            'descripcion' => 'Chequeo general.',
            'comentario' => 'Revisión de peso y vacunación.',
            'precio' => 30.00,
        ]);

        Event::create([
            'user_id' => 7,
            'title' => 'Lavado Canino',
            'fecha'  => '2025-05-22',
            'start'  => '2025-05-22 10:00:00',
            'end'    => '2025-05-22 11:00:00',
            'tipo' => 'lavado',
            'descripcion' => 'Baño completo y secado.',
            'comentario' => 'Asegurarse de que el perro quede bien seco.',
            'precio' => 18.00,
        ]);

        // Usuario 8
        Event::create([
            'user_id' => 8,
            'title' => 'Peluquería Canina',
            'fecha'  => '2025-05-23',
            'start'  => '2025-05-23 08:30:00',
            'end'    => '2025-05-23 09:30:00',
            'tipo' => 'peluqueria',
            'descripcion' => 'Corte de pelo y limpieza.',
            'comentario' => 'Perro mediano.',
            'precio' => 35.00,
        ]);

        Event::create([
            'user_id' => 8,
            'title' => 'Cita Veterinaria',
            'fecha'  => '2025-05-25',
            'start'  => '2025-05-25 15:00:00',
            'end'    => '2025-05-25 15:30:00',
            'tipo' => 'cita veterinaria',
            'descripcion' => 'Chequeo anual.',
            'comentario' => 'Verificar estado general de salud.',
            'precio' => 40.00,
        ]);

        // Usuario 9
        Event::create([
            'user_id' => 9,
            'title' => 'Pedicura Canina',
            'fecha'  => '2025-05-28',
            'start'  => '2025-05-28 12:00:00',
            'end'    => '2025-05-28 13:00:00',
            'tipo' => 'pedicura',
            'descripcion' => 'Corte de uñas y limpieza.',
            'comentario' => 'Perro pequeño.',
            'precio' => 15.00,
        ]);

        Event::create([
            'user_id' => 9,
            'title' => 'Lavado Canino',
            'fecha'  => '2025-05-30',
            'start'  => '2025-05-30 14:00:00',
            'end'    => '2025-05-30 15:00:00',
            'tipo' => 'lavado',
            'descripcion' => 'Baño completo.',
            'comentario' => 'Para perro de pelo largo.',
            'precio' => 25.00,
        ]);

        // Usuario 10
        Event::create([
            'user_id' => 10,
            'title' => 'Cita Veterinaria',
            'fecha'  => '2025-05-29',
            'start'  => '2025-05-29 10:00:00',
            'end'    => '2025-05-29 10:30:00',
            'tipo' => 'cita veterinaria',
            'descripcion' => 'Chequeo general y vacunas.',
            'comentario' => 'Asegurarse de que las vacunas estén al día.',
            'precio' => 30.00,
        ]);
    }}
