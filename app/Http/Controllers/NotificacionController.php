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
        // Limpiamos variables de sesion previas
        session()->forget('notificaciones_asunto');
        session()->forget('notificaciones_estado');

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

    public function indexNumNoLeidas(){
        try{
        $num_notificaciones = Notificacion::where('id_empleado_destino', auth()->user()->empleado->id)
                ->where('eliminada', false)
                ->where('leido', false)
                ->count();

        return response()->json(['num_notificaciones' => $num_notificaciones], 200);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updateMarcarLeido()
    {
        try{

         $notificaciones = Notificacion::where('id_empleado_destino', auth()->user()->empleado->id)->where('eliminada', false);
         $notificaciones->update(['leido' => true]);
        return back()->with('estado', 'marcadas');
        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public static function numNotificacionesNoLeidas(){

        try{

            if( auth()->user()->empleado->id != null){
                 $num_notificaciones = Notificacion::where('id_empleado_destino', auth()->user()->empleado->id)
                ->where('eliminada', false)
                ->where('leido', false)
                ->count();
                return $num_notificaciones;

            }else{
                return 0;
            }
           

        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

      public function indexFiltrar(Request $request)
    {
        try{

        switch($request->input('tipo')){
            
            case 'notificaciones_recibidas':

                  $notificaciones = DB::table('notificacions')
                    ->where('notificacions.id_empleado_destino', auth()->user()->empleado->id)
                    ->where('notificacions.eliminada', false)
                    ->where('notificacions.titulo', 'like', "%{$request->input('titulo')}%")
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


            break;

            case 'notificaciones_enviadas':

                     $notificaciones = DB::table('notificacions')
                    ->where('notificacions.id_empleado_origen', auth()->user()->empleado->id)
                    ->where('notificacions.titulo', 'like', "%{$request->input('titulo')}%")
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

            break;
            
            case 'notificaciones_eliminadas':

                $notificaciones = DB::table('notificacions')
                    ->where('notificacions.id_empleado_destino', auth()->user()->empleado->id)
                    ->where('notificacions.titulo', 'like', "%{$request->input('titulo')}%")
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



            break;

            default:

            break;
        }

        session()->flash('notificaciones_asunto', $request->input('tipo'));
        return view('Notificacion.index', ['notificaciones' => $notificaciones]);

        } catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

        public function indexEstado($estado)
    {
        try{
        
        if($estado == 'Todas'){
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

        }  
        else{

              $estadoNotificacion = ($estado == 'Leidas') ? true : false;   
                $notificaciones = DB::table('notificacions')
                ->where('notificacions.id_empleado_destino', auth()->user()->empleado->id)
                ->where('notificacions.eliminada', false)
                ->where('notificacions.leido', $estadoNotificacion)
                ->join('empleados', 'empleados.id', '=', 'notificacions.id_empleado_origen')
                ->select(
                    'notificacions.id',
                    'notificacions.created_at',
                    'notificacions.leido',
                    'notificacions.titulo',
                    DB::raw('CONCAT(empleados.nombre, " ", empleados.apellidos) as Origen'))            
                ->orderBy('created_at', 'desc')
                ->paginate(10);


        }
            
      
        $destinatario = auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos;

        foreach ($notificaciones as $notificacion) {
            $notificacion->Destinatario = $destinatario;
        }

        session()->flash('notificaciones_estado', $estado);
        return view('Notificacion.index', ['notificaciones' => $notificaciones]);

        } catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

        public function indexSend()
    {
        try{
               // Limpiamos variables de sesion previas
            session()->forget('notificaciones_asunto');
            session()->forget('notificaciones_estado');

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
               // Limpiamos variables de sesion previas
                session()->forget('notificaciones_asunto');
                session()->forget('notificaciones_estado');

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


   public function showFiltrar($tipo)
    {
        try{

            return view('Notificacion.show-filter', ['tipo' => $tipo]);

        }catch(Exepcion $e){
        
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{

            if($this->esNotificacionEmpleadoAuth($id) == false){
                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no puede leer notificaciones ni conversaciones que no son suyas.']);
            }else{
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
            }
         

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

            public function updateRecuperar($id_notificacion)
    {
        try{

            $notificacion = Notificacion::find($id_notificacion);

            $notificacion->eliminada = false;
            $notificacion->save();

            return redirect()->route('notificacion.index');

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($notificacion)
    {
        try{

            $notificacion_eliminada = Notificacion::find($notificacion)->delete();
            return back()->with('estado', 'eliminado');
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
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


    public function esNotificacionEmpleadoAuth($id_notificacion){

        try{

            $notificacion = Notificacion::find($id_notificacion);
            if($notificacion->id_empleado_destino == auth()->user()->empleado->id || $notificacion->id_empleado_origen == auth()->user()->empleado->id){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
