<?php
// app/Models/Animal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre', 'tipo', 'raza', 'sexo', 'fechaNacimiento', 'imagen', 'observaciones', 'cliente_id'
    ];

    /**
     * Relación de pertenencia a un Cliente
     * Un animal pertenece a un cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación de un animal con las consultas
     * Un animal tiene muchas consultas
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    /**
     * Relación de un animal con los servicios
     * Un animal tiene muchos servicios
     */
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}

