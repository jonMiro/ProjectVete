<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
    public function run()
    {
        Post::create([
            'user_id'  => 1,
            'titulo'   => 'Guía básica para el cuidado de gatos',
            'contenido'=> '
        Bienvenido a la guía básica para el cuidado de gatos.

        Si estás pensando en adoptar un gato o ya tienes uno, esta guía te ayudará a proporcionarle los cuidados esenciales para que crezca sano y feliz.

        10 Consejos para cuidar de tu gatito:

        1. Visita al veterinario: Es fundamental llevar a tu gato a un veterinario para su primera revisión y vacunación.
        2. Alimentación adecuada: Proporciónale un alimento de calidad, específico para su edad (gatito, adulto o senior).
        3. Agua fresca siempre disponible: Los gatos tienden a beber poca agua, así que asegúrate de que tengan acceso constante a agua limpia.
        4. Arenero limpio: Limpia su arenero diariamente para evitar olores y enfermedades.
        5. Espacio seguro: Crea un ambiente donde pueda explorar sin peligro (sin cables sueltos, plantas tóxicas o ventanas abiertas sin protección).
        6. Socialización y cariño: Dedícale tiempo de juego y mimos. Esto fortalecerá vuestro vínculo y ayudará a su desarrollo emocional.
        7. Rascadores y juguetes: Proporciónale rascadores para que no dañe tus muebles, y juguetes para estimular su mente y cuerpo.
        8. Cuida su higiene: Aunque los gatos se acicalan solos, un cepillado regular ayuda a eliminar el pelo muerto y prevenir bolas de pelo.
        9. Esterilización/castración: Consulta con tu veterinario la mejor edad para esterilizar o castrar a tu gato y así evitar problemas de salud o comportamiento.
        10. Identificación: Aunque viva en casa, considera ponerle un microchip y un collar con identificación en caso de que se escape.

        Siguiendo estos consejos, estarás asegurando una vida larga, saludable y feliz para tu pequeño felino. ¡Disfruta de tu compañero gatuno!
            ',
            'imagen'   => null,
            'tipo'     => 'guia',
        ]);


        Post::create([
            'user_id'  => 6,
            'titulo'   => 'Nuevo servicio de urgencias 24/7',
            'contenido'=> 'Nos complace anunciar que ahora contamos con atención de emergencias veterinarias las 24 horas...',
            'imagen'   => null,
            'tipo'     => 'anuncio',
        ]);

        Post::create([
            'user_id'  => 5,
            'titulo'   => 'Experiencia: Salvando a un perrito callejero',
            'contenido'=> 'Hoy queremos compartir la emotiva historia de Max, un perrito que rescatamos en condiciones muy críticas...',
            'imagen'   => null,
            'tipo'     => 'experiencia',
        ]);
    }
}
