<?php

// app/Models/Servicio.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'animal_id','fecha','hora', 'tipo_servicio', 'descripcion', 'duracion', 'precio'
    ];

    /**
     * Servici perteneix a usuari (tipo auxiliar)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * servici perteneix a animal
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
