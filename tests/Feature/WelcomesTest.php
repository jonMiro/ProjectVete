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
        // Hacemos una solicitud GET a la ruta raíz
        $response = $this->get('/');  // Asumimos que la página de bienvenida está en la ruta raíz ('/')

        // Verifica que la respuesta es exitosa (código HTTP 200)
        $response->assertStatus(200);


        // Puedes comprobar si el componente Inertia esperado es el correcto
        $response->assertInertia(fn ($page) => $page->component('Welcome'));
    }
}
