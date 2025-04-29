<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'id_usuario',
        'tiempo_fichaje',
    
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
