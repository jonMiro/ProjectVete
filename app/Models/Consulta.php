<?php

// app/Models/Consulta.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id', 'veterinario_id', 'fecha', 'lugar', 'peso', 'tipo_animal', 'raza',
        'motivo', 'anamnesis', 'examen_fisico', 'diagnostico', 'tratamiento', 'observaciones'
    ];

    /**
     * Relación de una consulta con el veterinario
     * Una consulta es realizada por un veterinario
     */
    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class);
    }

    /**
     * Relación de una consulta con el animal
     * Una consulta es realizada a un animal
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
