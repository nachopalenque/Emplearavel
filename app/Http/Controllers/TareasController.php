<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TareasController extends Controller
{

    public function index()
    {
        try{
                $tareas = DB::table('eventos')
                ->where('eventos.id_empleado', auth()->user()->empleado->id)
                ->join('proyectos', 'eventos.id_proyecto', '=', 'proyectos.id')
                ->select(
                    'eventos.id',
                    'proyectos.nombre',
                    'eventos.titulo',
                    'eventos.observaciones',
                    'eventos.fecha_inicio',
                    'eventos.fecha_fin',
                    'eventos.estado_evento'
          
                )
                ->groupBy(
                    'eventos.id',
                    'proyectos.nombre',
                    'eventos.titulo',
                    'eventos.observaciones',
                    'eventos.fecha_inicio',
                    'eventos.fecha_fin',
                    'eventos.estado_evento'
             
                )
                ->paginate(10);

            return view('Tareas.index', ['tareas' => $tareas]);

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
