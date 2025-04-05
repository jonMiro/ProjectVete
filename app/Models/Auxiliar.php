<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    use HasFactory;

    // Define el nombre correcto de la tabla
    protected $table = 'auxiliares';  // Asegúrate de que sea 'auxiliares' y no 'auxiliars'

    protected $fillable = ['nombre', 'apellidos', 'telefono', 'direccion', 'correo'];

    /**
     * Relación con el modelo User (relación polimórfica inversa).
     */
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    /**
     * Relación con el historial de servicios (un auxiliar puede realizar varios servicios).
     */
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}
