<?php

namespace Tests\Feature;

use Tests\TestCase;

class WelcomesTest extends TestCase
{
    /**
     * Verifica que la página de bienvenida carga correctamente.
     *
     * @return void
     */
    public function test_welcome_page_is_accessible()
    {
        $response = $this->get('/');  // Asumimos que la página de bienvenida está en la ruta raíz ('/')

        // Verifica que la respuesta es exitosa (código HTTP 200)
        $response->assertStatus(200);

        // Opcionalmente, también puedes verificar que algún texto específico esté presente en la página
        $response->assertSee('Bienvenido');  // Cambia 'Bienvenido' por el texto que aparece en tu página
    }
}
