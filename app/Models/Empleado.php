<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;



    protected $fillable = [
        'id',
        'seguridad_social',
        'dni',
        'nombre',
        'apellidos',
        'provincia',
        'localidad',
        'codigo_postal',
        'direccion',
        'pais',
        'puesto',
        'created_at',
        'updated_at',
    
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function dias()
    {
        return $this->hasMany(Dia::class);
    }

        public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_empleado');
    }

}
