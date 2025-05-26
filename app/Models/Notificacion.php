<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

        protected $fillable = [
        'id',
        'created_at',
        'leido',
        'titulo',
        'Origen',
        'Destinatario',

    ];
    public function origen()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_origen');
    }

    public function destino()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_destino');
    }
}
