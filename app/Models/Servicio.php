<?php

// app/Models/Servicio.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'auxiliar_id', 'animal_id', 'tipo_servicio', 'descripcion', 'duracion', 'precio'
    ];

    /**
     * Relación de un servicio con el auxiliar
     * Un servicio es realizado por un auxiliar
     */
    public function auxiliar()
    {
        return $this->belongsTo(Auxiliar::class);
    }

    /**
     * Relación de un servicio con el animal
     * Un servicio es realizado a un animal
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
