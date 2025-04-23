<?php
// app/Models/Animales.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animales';


    protected $fillable = [
        'nombre', 'tipo', 'raza', 'sexo', 'fechaNacimiento', 'imagen', 'observaciones', 'user_id'
    ];


     /* Relación de pertenencia a un Cliente*/
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Relación de un animal con las consultas
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    /**
     * Relación de un animal con los servicios
     */
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}

