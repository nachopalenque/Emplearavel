<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Evento;

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

     public function show($id)
    {
        try{
                $tareas = DB::table('eventos')
                ->where('eventos.id_empleado', $id)
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

            return view('Tareas.show', ['tareas' => $tareas]);

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        try{

        return view('Tareas.edit', ['id_evento'=> $id]);

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try{

            $evento = Evento::find($request->input('id_evento'));
            $evento->estado_evento = $request->input('estado_evento');
            $evento->save();
            session()->flash('estado', 'actualizado');
            return redirect()->route('tareas.index');

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
