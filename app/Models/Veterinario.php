<?php

// app/Models/Veterinario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'apellidos', 'especialidad', 'telefono', 'direccion', 'correo'
    ];

    /**
     * Relación polimórfica con el modelo User
     * Un veterinario pertenece a un usuario (User)
     */
    public function userable()
    {
        return $this->morphOne(User::class, 'userable');
    }

    // Relación con las consultas
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
}
