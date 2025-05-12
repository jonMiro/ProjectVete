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

        Post::create([
            'user_id'  => 5,
            'titulo'   => 'Cachorros en adopción',
            'contenido'=> '¡Hola a todos! Mi perra acaba de tener una camada de cachorros y estoy buscando buenos hogares para ellos. Son muy cariñosos y saludables. Si estás interesado en adoptarlos, por favor contacta con el centro veterinario.',
            'imagen'   => null,
            'tipo'     => 'anuncio',
        ]);

        Post::create([
            'user_id'  => 6,
            'titulo'   => 'Urgente: Buscamos ayuda para nuestra protectora',
            'contenido'=> 'Estamos buscando ayuda para nuestra protectora de animales. Necesitamos voluntarios para atender a los animales, así como donaciones para poder continuar con nuestra labor. Si puedes ayudar de alguna manera, por favor, contacta con nosotros. Nuestra protectora es LaVall.es',
            'imagen'   => null,
            'tipo'     => 'anuncio',
        ]);

        Post::create([
            'user_id'  => 7,
            'titulo'   => 'Experiencia: Rescate de un gato atrapado',
            'contenido'=> 'Hoy tuvimos una experiencia bastante impactante, rescatamos a un gato que había quedado atrapado en un árbol durante horas. Gracias a la ayuda de un equipo de rescate, el gatito está a salvo. ¡Una gran lección sobre la importancia de ayudar a los animales en apuros!',
            'imagen'   => null,
            'tipo'     => 'experiencia',
        ]);

       Post::create([
    'user_id'  => 8,
    'titulo'   => 'Guía completa sobre la diabetes en perros',
    'contenido'=> '
La diabetes canina es una enfermedad metabólica que afecta a perros de todas las edades, tamaños y razas. Aunque puede sonar preocupante, con el diagnóstico temprano y el tratamiento adecuado, los perros con diabetes pueden llevar una vida larga y saludable.

### ¿Qué es la diabetes canina?
La diabetes en perros ocurre cuando el páncreas no produce suficiente insulina o cuando el cuerpo no responde adecuadamente a la insulina. La insulina es una hormona que ayuda a las células a absorber la glucosa (azúcar), que es utilizada como fuente de energía.

### Síntomas comunes de la diabetes en perros:
- Aumento de la sed (polidipsia).
- Aumento de la micción (poliuria).
- Pérdida de peso a pesar de un aumento en el apetito.
- Fatiga o letargo.
- Cambio en el pelaje (a menudo se vuelve opaco).
- Infecciones recurrentes de la piel o las vías urinarias.

### Diagnóstico:
Si sospechas que tu perro tiene diabetes, es importante consultar a tu veterinario. El diagnóstico se realiza mediante análisis de sangre y orina para medir los niveles de glucosa.

### Tratamiento:
1. **Insulina**: La mayoría de los perros diabéticos requieren inyecciones de insulina varias veces al día. Tu veterinario te enseñará a administrarlas correctamente.
2. **Dieta**: Es fundamental proporcionar una dieta controlada, rica en fibra y baja en grasas. Consulta con tu veterinario para elegir el mejor alimento para tu perro.
3. **Monitoreo constante**: Es importante controlar regularmente los niveles de glucosa en sangre de tu perro. Los veterinarios pueden recomendarte cómo hacerlo en casa.

### Consejos adicionales:
- Mantén una rutina constante en la administración de la insulina y la comida.
- Haz ejercicio regularmente para ayudar a controlar el peso y los niveles de glucosa.
- Realiza chequeos periódicos con tu veterinario para ajustar el tratamiento según sea necesario.

Con el cuidado adecuado, tu perro puede vivir feliz y saludable a pesar de la diabetes. ¡No dudes en consultar con un profesional para recibir el mejor consejo y tratamiento!
',
    'imagen'   => null,
    'tipo'     => 'guia',
]);


       Post::create([
    'user_id'  => 9,
    'titulo'   => 'Guía para higienizar el área donde los gatitos hacen sus necesidades',
    'contenido'=> '
Mantener limpia el área donde los gatitos hacen sus necesidades es fundamental para su salud y bienestar. Los gatos son animales muy limpios por naturaleza, y una zona sucia puede provocarles estrés, enfermedades e incluso evitar que usen el arenero correctamente. Aquí te damos algunos consejos para mantener esta zona higiénica.

### 1. **Elige el arenero adecuado**:
El tipo de arenero es clave. Los gatos prefieren areneros cerrados, ya que les otorgan privacidad. Sin embargo, algunos gatos prefieren areneros abiertos. Asegúrate de elegir el que más le guste a tu gato.

### 2. **Limpieza diaria**:
- **Retira los excrementos y la orina**: Una vez al día, elimina los desechos sólidos y líquidos del arenero. Puedes usar una pala para arenero de plástico o metálica.
- **Añade arena fresca**: Después de retirar los desechos, agrega un poco más de arena limpia para mantener la absorción adecuada.

### 3. **Limpieza profunda semanal**:
- **Vacía todo el arenero**: Una vez por semana, vacía todo el contenido del arenero. Lava el arenero con agua caliente y un detergente suave para eliminar cualquier residuo.
- **Desinfecta**: Utiliza un desinfectante seguro para gatos para limpiar las paredes del arenero, asegurándote de que no queden residuos del producto de limpieza.
- **Seca bien**: Asegúrate de que el arenero esté completamente seco antes de volver a añadir la arena.

### 4. **Coloca el arenero en un lugar adecuado**:
- El arenero debe estar en un lugar tranquilo y apartado, pero accesible para el gato. Evita ponerlo cerca de su zona de comida o bebida.
- Asegúrate de que el arenero tenga buena ventilación para evitar malos olores.

### 5. **Controla los olores**:
- Si el olor es un problema, puedes considerar el uso de arena para gatos con control de olores. Algunas arenas contienen ingredientes que ayudan a neutralizar los malos olores.
- Evita usar productos de limpieza con fragancias artificiales, ya que a los gatos no les gustan los olores fuertes.

### 6. **Fomenta la limpieza con el gato**:
- Algunos gatos pueden ser muy exigentes con la limpieza de su arenero. Asegúrate de mantenerlo limpio y cambia la arena regularmente para evitar que tu gato se niegue a usarlo.

Una limpieza adecuada y regular no solo mejora la salud de tu gato, sino también la higiene de tu hogar. Si sigues estos consejos, estarás asegurando que tu gato se sienta cómodo y feliz en su espacio.
',
    'imagen'   => null,
    'tipo'     => 'guia',
]);


        Post::create([
            'user_id'  => 10,
            'titulo'   => 'Ayuda urgente para alimentar a gatitos abandonados',
            'contenido'=> 'Encontré una camada de gatitos abandonados en la calle y no tengo suficiente comida para alimentarlos. Si tienes comida para gatos o cualquier tipo de ayuda, por favor, comunícate conmigo lo antes posible.
            Mi numero de telefono es 675694332, pueden contactar conmigo por whatsapp',
            'imagen'   => null,
            'tipo'     => 'anuncio',
        ]);

        Post::create([
            'user_id'  => 5,
            'titulo'   => 'Busco a mi loro perdido',
            'contenido'=> 'Mi loro se ha escapado y no lo encuentro. Es de color verde con amarillo y tiene un pequeño collar rojo. Si alguien lo ha visto, por favor avísenme, lo extraño mucho. Mi telefono es 653626177',
            'imagen'   => null,
            'tipo'     => 'anuncio',
        ]);

        Post::create([
            'user_id'  => 6,
            'titulo'   => 'Mujer ofrece medicación para las defensas',
            'contenido'=> 'Tengo un tratamiento de medicación para reforzar el sistema inmunológico que ya no voy a usar. Si alguien lo necesita, por favor, contacta conmigo para ver cómo podemos hacer entrega.
            Si lo necesitan ponganse en contacto con la veterinaria y ellos me notificarán. Muchas gracias',
            'imagen'   => null,
            'tipo'     => 'anuncio',
        ]);

        Post::create([
            'user_id'  => 7,
            'titulo'   => 'Experiencia: Salvar a un perro en la carretera',
            'contenido'=> 'El otro día me encontré con un perro atropellado en la carretera, lo llevé al veterinario y, afortunadamente, pudo sobrevivir. ¡Es increíble lo que un poco de compasión puede hacer por un ser indefenso!',
            'imagen'   => null,
            'tipo'     => 'experiencia',
        ]);

        Post::create([
            'user_id'  => 8,
            'titulo'   => 'Historias de adopción: Mi perra rescatada',
            'contenido'=> 'Hace unos meses adopté a una perra que había sido maltratada. Hoy, está completamente feliz y sana, y quiero compartir su historia para animar a más personas a adoptar. ¡La adopción es una maravillosa opción!',
            'imagen'   => null,
            'tipo'     => 'experiencia',
        ]);
    }
}
