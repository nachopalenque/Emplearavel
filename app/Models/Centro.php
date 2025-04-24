<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'razon_social',
        'direccion',
        'pais',
        'provincia',
        'localidad',
        'codigo_postal',
        'CIF',

    ];
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
