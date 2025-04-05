<?php
// app/Models/Cliente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellidos', 'telefono', 'direccion', 'correo'
    ];

    /**
     * Relación polimórfica con el modelo User
     * Un cliente pertenece a un usuario (User)
     */
    public function userable()
    {
        return $this->morphOne(User::class, 'userable');
    }

    // Relación con los animales
    public function animales()
    {
        return $this->hasMany(Animal::class);
    }
}
