<?php


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


     /* Animal pertenenix a usuari (tipo client)*/
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Animal te moltes consultes
     */
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    /**
     * Animal te molts servicis
     */
    public function servicios()
    {
        return $this->hasMany(Servicio::class);
    }
}

