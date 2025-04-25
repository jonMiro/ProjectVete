<?php

// app/Models/Consulta.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id', 'user_id', 'fecha','hora', 'lugar', 'peso', 'tipo_animal', 'raza',
        'motivo', 'anamnesis', 'examen_fisico', 'diagnostico', 'tratamiento', 'observaciones', 'precio'
    ];

    /**
     * Relación de una consulta con el veterinario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación de una consulta con el animal
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
