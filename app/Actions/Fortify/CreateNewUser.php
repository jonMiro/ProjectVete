<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validación de los nuevos campos
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],  // Nuevo campo
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'direccion' => ['required', 'string', 'max:255'],  // Nuevo campo
            'telefono' => ['required', 'string', 'max:15'],  // Nuevo campo
            'tipo' => ['required', 'string', 'in:veterinario,auxiliar,cliente'],  // Nuevo campo
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear el usuario con los nuevos campos
        return User::create([
            'name' => $input['name'],
            'apellidos' => $input['apellidos'],  // Nuevo campo
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'direccion' => $input['direccion'],  // Nuevo campo
            'telefono' => $input['telefono'],  // Nuevo campo
            'tipo' => $input['tipo'],  // Nuevo campo
        ]);
    }
}
