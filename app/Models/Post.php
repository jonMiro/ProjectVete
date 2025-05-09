<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
        'tipo',
        'user_id',
    ];

    /**
     * Post perteneix a user (qualsevol tipo)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
