<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

        protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'estado',
        'fecha_fin',
        'created_at',
        'updated_at',
        'progreso_proyecto',

 
        

    ];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'proyecto_empleado', 'id_proyecto', 'id_empleado');
    }
}
