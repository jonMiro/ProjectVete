<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function test_new_users_can_register(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        // Datos de usuario para registrar
        $userData = [
            'name' => 'Test User',
            'apellidos' => 'Test Apellido',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'direccion' => '123 Test Street',
            'telefono' => '1234567890',
            'tipo' => 'cliente', // Definir tipo
            'is_worker' => false, // Puede ser true si deseas un trabajador
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ];

        // Realiza la solicitud POST para registrar al usuario
        $response = $this->post('/register', $userData);

        // Verifica que el usuario esté autenticado
        $this->assertAuthenticated();

        // Verifica que la redirección se haya hecho correctamente a la página de inicio (dashboard)
        $response->assertRedirect(route('dashboard', absolute: false));

        // También puedes agregar una verificación para asegurarte de que los datos están en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'name' => 'Test User',
            'apellidos' => 'Test Apellido',
            'direccion' => '123 Test Street',
            'telefono' => '1234567890',
            'tipo' => 'cliente',
            'is_worker' => false,
        ]);
    }
}
