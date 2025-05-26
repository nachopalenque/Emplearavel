<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
        $notificaciones = DB::table('notificacions')
                ->where('notificacions.id_empleado_destino', auth()->user()->empleado->id)
                ->where('notificacions.eliminada', false)
                ->join('empleados', 'empleados.id', '=', 'notificacions.id_empleado_origen')
                ->select(
                    'notificacions.id',
                    'notificacions.created_at',
                    'notificacions.leido',
                    'notificacions.titulo',
                    DB::raw('CONCAT(empleados.nombre, " ", empleados.apellidos) as Origen'))            
                ->orderBy('created_at', 'desc')
                ->paginate(10);

        $destinatario = auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos;

        foreach ($notificaciones as $notificacion) {
            $notificacion->Destinatario = $destinatario;
        }
        return view('Notificacion.index', ['notificaciones' => $notificaciones]);

        } catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

        public function indexSend()
    {
        try{
            $notificaciones = DB::table('notificacions')
                    ->where('notificacions.id_empleado_origen', auth()->user()->empleado->id)
                    ->join('empleados', 'empleados.id', '=', 'notificacions.id_empleado_destino')
                    ->select(
                        'notificacions.id',
                        'notificacions.created_at',
                        'notificacions.leido',
                        'notificacions.titulo',
                        DB::raw('CONCAT(empleados.nombre, " ", empleados.apellidos) as Destinatario'))            
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

            $origen = auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos;

            foreach ($notificaciones as $notificacion) {
                $notificacion->Origen = $origen;
            }

            return view('Notificacion.index-send', ['notificaciones' => $notificaciones]);

        } catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


         public function indexDel()
    {
        try{
               $notificaciones = DB::table('notificacions')
                ->where('notificacions.id_empleado_destino', auth()->user()->empleado->id)
                ->where('notificacions.eliminada', true)
                ->join('empleados', 'empleados.id', '=', 'notificacions.id_empleado_origen')
                ->select(
                    'notificacions.id',
                    'notificacions.created_at',
                    'notificacions.leido',
                    'notificacions.titulo',
                    DB::raw('CONCAT(empleados.nombre, " ", empleados.apellidos) as Origen'))            
                ->orderBy('created_at', 'desc')
                ->paginate(10);

        $destinatario = auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos;

        foreach ($notificaciones as $notificacion) {
            $notificacion->Destinatario = $destinatario;
        }

            return view('Notificacion.index-del', ['notificaciones' => $notificaciones]);

        } catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

        $empleado_destino = Empleado::whereRaw("CONCAT(nombre, ' ', apellidos) = ?", [$request->input('empleado')])->first();
        $notificacion = new Notificacion();
        $notificacion->id_empleado_origen = auth()->user()->empleado->id;
        $notificacion->id_empleado_destino = $empleado_destino->id;
        $notificacion->titulo = $request->input('titulo');
        $notificacion->mensaje = $request->input('texto');
        $notificacion->save();

        return redirect()->route('notificacion.index');

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notificacion $notificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            //marco como leida la notificacion
            $notificacion_leida = Notificacion::find($id);
            $notificacion_leida->leido = true;
            $notificacion_leida->save();
            $notificacion = DB::table('notificacions')
                ->where('notificacions.id', $id)
                ->join('empleados', 'empleados.id', '=', 'notificacions.id_empleado_origen')
                ->select(
                    'notificacions.id',
                    'notificacions.titulo',
                    'notificacions.mensaje',
                    DB::raw('CONCAT(empleados.nombre, " ", empleados.apellidos) as remitente'))
                ->first();            
            
            return view('Notificacion.edit', ['notificacion' => $notificacion]);

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $notificacion)
    {
        try{

            $notificacion_origen = Notificacion::find($notificacion);
            $notificacion_destino = New Notificacion();

            $notificacion_destino->id_empleado_origen = $notificacion_origen->id_empleado_destino;
            $notificacion_destino->id_empleado_destino = $notificacion_origen->id_empleado_origen;
            $notificacion_destino->titulo = $notificacion_origen->titulo . '(Respuesta)';
            $notificacion_destino->mensaje = $request->input('respuesta');
            $notificacion_destino->save();

            return redirect()->route('notificacion.index');

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }    
    }

        public function updateDelete($id_notificacion)
    {
        try{

            $notificacion = Notificacion::find($id_notificacion);

            $notificacion->eliminada = true;
            $notificacion->save();

            return redirect()->route('notificacion.index');

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }

    public function destroyAll(Notificacion $notificacion)
    {
        try{
            
            $notificacion = Notificacion::where('id_empleado_destino', auth()->user()->empleado->id)
            ->where('eliminada', true)
            ->delete();

            return redirect()->route('notificacion.indexDel');

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
