<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Empleado;
use App\Models\Proyecto;
use App\Models\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{

        //eventos de la base de datos
        $eventos = Evento::where('id_empleado', auth()->user()->empleado->id)->get();
        //variable que almacena los eventos para el calendario con sus campos especificos
        $eventos_calendar = [];

        foreach ($eventos as $evento) {
            $eventos_calendar[] = [
                'title' => $evento->titulo,
                'start' => $evento->fecha_inicio,
                'end' => $evento->fecha_fin
            ];
        }
        
            return view('Evento.index', compact('eventos_calendar'));

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_empleado = null)
    {
        if($id_empleado == null){
            $id_empleado = auth()->user()->empleado->id;
        }
        return view('Evento.create-id-empleado', ['id_empleado' => $id_empleado]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            
            //creando el evento para el proyecto
            if($request->input('id_proyecto') != null){

                $request->validate([
                    'adjunto' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
                ]);


                $proyecto = Proyecto::find($request->input('id_proyecto'));           
                $evento = new Evento();
                $evento->id_empleado = auth()->user()->empleado->id;
                $evento->id_proyecto = $proyecto->id;
                $evento->titulo = 'Añadido archivo de proyecto '. $request->input('adjunto'); 
                $evento->fecha_inicio = Now();
                $evento->fecha_fin = Now();
                $evento->tipo_evento = 'Archivo de proyecto';
                $evento->observaciones = 'Añadido archivo de proyecto '. $request->input('adjunto');
                $evento->estado_evento = 'Pendiente';

                if ($request->hasFile('adjunto')) {
                    $nombreOriginal = $request->file('adjunto')->getClientOriginalName(); 
                    $ruta = $request->file('adjunto')->storeAs($proyecto->intranet.'/'.$nombreOriginal);
                    $evento->adjunto = $proyecto->intranet.'/'.$nombreOriginal;

                }
                $evento->save();
                $this->createNotificacionEvent('evento_proyecto', $evento);

                return redirect()->route('proyecto.index')->with('estado', 'creado');
           
            }

            //creando el evento de empleado
            else{

                // Validar manualmente
              $validacion = $request->validate([
                    'titulo' => 'required',
                    'fecha_inicio' => 'required|date|after_or_equal:today',
                    'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                    'tipo_evento' => 'required',
                    'observaciones' => 'required',
                    'adjunto' => 'file|mimes:jpg,png,pdf,docx|max:2048',
                ]);


                $evento = new Evento();
                $evento->titulo = $request->input('titulo');
                $evento->fecha_inicio = $request->input('fecha_inicio');
                $evento->fecha_fin = $request->input('fecha_fin');
                $evento->tipo_evento = $request->input('tipo_evento');
                $evento->observaciones = $request->input('observaciones');
                $evento->estado_evento = 'Pendiente';
                $evento->adjunto = '';

                if($request->input('id_empleado') != null){

                    $empleado = Empleado::find($request->input('id_empleado'));
                    $evento->id_empleado = $request->input('id_empleado');

                        if ($request->hasFile('adjunto')) {
                            $nombreOriginal = $request->file('adjunto')->getClientOriginalName(); 

                            // Guardar en una carpeta personalizada dentro de `storage/app`
                            $ruta = $request->file('adjunto')->storeAs('intranet/'.$empleado->user->centro->nombre.'/empleados/'.$empleado->nombre, $nombreOriginal);

                            // Obtener URL accesible (si usas `storage:link`)
                            //$url = Storage::url($ruta);

                            // Puedes guardar $url en la base de datos, por ejemplo:
                            // Documento::create(['archivo_url' => $url]);
                            
                            $evento->adjunto ='intranet/'.$empleado->user->centro->nombre.'/empleados/'.$empleado->nombre.'/'.$nombreOriginal;
                        }

                }else{
                    $evento->id_empleado = auth()->user()->empleado->id;
                        
                        if ($request->hasFile('adjunto')) {
                            $nombreOriginal = $request->file('adjunto')->getClientOriginalName(); 

                            // Guardar en una carpeta personalizada dentro de `storage/app`
                            $ruta = $request->file('adjunto')->storeAs('intranet/'.auth()->user()->centro->nombre.'/empleados/'.auth()->user()->empleado->nombre, $nombreOriginal);

                            // Obtener URL accesible (si usas `storage:link`)
                            //$url = Storage::url($ruta);

                            // Puedes guardar $url en la base de datos, por ejemplo:
                            // Documento::create(['archivo_url' => $url]);
                            
                            $evento->adjunto ='intranet/'.auth()->user()->centro->nombre.'/empleados/'.auth()->user()->empleado->nombre.'/'.$nombreOriginal;
                        }

                }

                    $evento->save();

                    $this->createNotificacionEvent('evento_empleado', $evento);
                    return redirect()->route('evento.index')->with('estado', 'creado');


            }
            



        }
        
   
        catch(Exception $e){

        return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();

            
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
    }


    public static function createNotificacionEvent($tipo_notificacion, $evento=null, $centro=null, $usuario = null, $proyecto = null, $empleado = null){
        try{

            switch($tipo_notificacion){
                  case 'proyecto_nuevo_empleado':

                        //notificación al creador del proyecto
                        $notificacion = new Notificacion();
                        $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                        $notificacion->id_empleado_destino = $proyecto->empleados()->first()->id;
                        $notificacion->titulo = "Has asignado un nuevo empleado al proyecto ". $proyecto->nombre;
                        $notificacion->mensaje = "Has asignado el nuevo empleado  ". $empleado->nombre . " " . $empleado->apellidos . " al proyecto " . $proyecto->nombre;
                        $notificacion->save();
               

                        //notificación al empleado nuevo del proyecto
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $empleado->id;
                            $notificacion->titulo = "Has sido asignado a un nuevo proyecto ". $proyecto->nombre;
                            $notificacion->mensaje = "Has sido asignado a un nuevo proyecto ". $proyecto->nombre.": ". $proyecto->descripcion;
                            $notificacion->save();
                        
                    
               

                break;

                case 'proyecto_elimina_empleado':

                        //notificación al creador del proyecto
                        $notificacion = new Notificacion();
                        $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                        $notificacion->id_empleado_destino = $proyecto->empleados()->first()->id;
                        $notificacion->titulo = "Has eliminado un empleado al proyecto ". $proyecto->nombre;
                        $notificacion->mensaje = "Has eliminado el empleado  ". $empleado->nombre . " " . $empleado->apellidos . " al proyecto " . $proyecto->nombre;
                        $notificacion->save();
               

                        //notificación al empleado nuevo del proyecto
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $empleado->id;
                            $notificacion->titulo = "Has sido eliminado del proyecto ". $proyecto->nombre;
                            $notificacion->mensaje = "Has sido eliminado del proyecto ". $proyecto->nombre.": ". $proyecto->descripcion;
                            $notificacion->save();
                        
                    
               

                break;

                 case 'proyecto_nuevo':

                        //notificación al creador del proyecto
                        $notificacion = new Notificacion();
                        $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                        $notificacion->id_empleado_destino = $proyecto->empleados()->first()->id;
                        $notificacion->titulo = "Has creado un proyecto nuevo ". $proyecto->nombre;
                        $notificacion->mensaje = "Descripción del proyecto: ". $proyecto->descripcion;
                        $notificacion->save();
               

                        //notificación a todos los empleados del proyecto
                        $empleados_proyecto = $proyecto->empleados()->pluck('id_empleado')->toArray();
                        foreach($empleados_proyecto as $empleado){

                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $empleado;
                            $notificacion->titulo = "Añadido archivo a proyecto ". $proyecto->nombre;
                            $notificacion->mensaje = "Se ha añadido un archivo al proyecto ". $proyecto->adjunto;
                            $notificacion->save();
                        }
                    
               

                break;

                case 'proyecto_eliminar':

                        //notificación al creador del proyecto
                        $notificacion = new Notificacion();
                        $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                        $notificacion->id_empleado_destino = $proyecto->empleados()->first()->id;
                        $notificacion->titulo = "Has eliminado el proyecto ". $proyecto->nombre;
                        $notificacion->mensaje = "Descripción del proyecto eliminado: ". $proyecto->descripcion;
                        $notificacion->save();
               

                        //notificación a todos los empleados del proyecto
                        $empleados_proyecto = $proyecto->empleados()->pluck('id_empleado')->toArray();
                        foreach($empleados_proyecto as $empleado){

                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $empleado;
                            $notificacion->titulo = "El proyecto ". $proyecto->nombre ." ha sido eliminado";
                            $notificacion->mensaje = "El administrador del proyecto a eliminado el proyecto ". $proyecto->nombre;
                            $notificacion->save();
                        }
                    
               

                break;


                case 'evento_proyecto':

                        $proyecto = Proyecto::find($evento->id_proyecto);
                        $empleados_proyecto = $proyecto->empleados()->pluck('id_empleado')->toArray();
                        foreach($empleados_proyecto as $empleado){

                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $empleado;
                            $notificacion->titulo = "Añadido archivo a proyecto ". $proyecto->nombre;
                            $notificacion->mensaje = "Se ha añadido un archivo al proyecto ". $proyecto->adjunto;
                            $notificacion->save();
                        }
                    
               

                break;



                case 'evento_proyecto_actualizar':

                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $proyecto->empleados()->first()->id;
                            $notificacion->titulo = "Se ha actualizado el proyecto ". $proyecto->nombre;
                            $notificacion->mensaje = "El proyecto ". $proyecto->nombre." ha sido actualizado por ".auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos . ". Su estado actual es : ". $proyecto->estado . " con un porcentaje de progreso del ". $proyecto->progreso_proyecto."%";
                            $notificacion->save();
               

                break;




                case 'evento_empleado':

                            //notificación empleado del evento
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $evento->id_empleado;
                            $notificacion->titulo = "Notificacion de tipo : ". $evento->tipo_evento . " con fecha de inicio en : ". $evento->fecha_inicio . " y fecha de fin en : ". $evento->fecha_fin;
                            $notificacion->mensaje = $evento->observaciones;
                            $notificacion->save();
                            //notificación al usuario admin
                            $notificacion_Admin = new Notificacion();
                            $admin = Empleado::all()->first();
                            $notificacion_Admin->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion_Admin->id_empleado_destino = $admin->id;
                            $notificacion_Admin->titulo = "Notificacion del empleado : ". auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos . " de tipo : ". $evento->tipo_evento . " con fecha de inicio en : ". $evento->fecha_inicio . " y fecha de fin en : ". $evento->fecha_fin;
                            $notificacion_Admin->mensaje = $evento->observaciones;
                            $notificacion_Admin->save();
                        



                 
                break;   



                case 'evento_empleado_tarea':
                    
                            $proyecto = Proyecto::find($evento->id_proyecto);
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $evento->id_empleado;
                            $notificacion->titulo = "Se le asignado una tarea en el proyecto : ". $proyecto->nombre;
                            $notificacion->mensaje = $evento->observaciones;
                            $notificacion->save();
                        


                 
                break;   

                case 'evento_empleado_tarea_actualizacion':

                            $proyecto = Proyecto::find($evento->id_proyecto);
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = $proyecto->empleados()->first()->id;
                            $notificacion->titulo = "Se han hecho cambios en la tarea : ". $evento->titulo . " en el proyecto : ". $proyecto->nombre . " por el usuario : ". auth()->user()->empleado->nombre . " " . auth()->user()->empleado->apellidos;
                            $notificacion->mensaje = "Tarea en estado: ". $evento->estado_evento . " : " . $evento->observaciones;
                            $notificacion->save();
                        

                break; 
                
                case 'evento_centro_productivo_nuevo':

                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = Empleado::all()->first()->id;
                            $notificacion->titulo = "Se ha creado un centro productivo nuevo denominado : ". $centro->nombre . " por el empleado : ". auth()->user()->empleado->nombre . " " . auth()->user()->empleado->apellidos;
                            $notificacion->mensaje = "Se ha creado el centro productivo denominado :" .$centro->nombre . " de la localidad : " . $centro->localidad . " con la siguiente direccion : " . $centro->direccion;
                            $notificacion->save();

                break;
                
                case 'empleado_centro_nuevo':

                            //notificación administrativa
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = $usuario->empleado->id;
                            $notificacion->id_empleado_destino = Empleado::all()->first()->id;
                            $notificacion->titulo = "Se ha dado de alta el empleado : ". $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . " y asociado al centro productivo : ". $centro->nombre;
                            $notificacion->mensaje = "El empleado : " . $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . " con el rol de : " .$usuario->getRoleNames()->first() . ",  y correo : " . $usuario-> email . " desempeñara el puesto de : " . $usuario->empleado->puesto . " en el centro productivo :" .$centro->nombre . " de la localidad : " . $centro->localidad . " ubicado en : " . $centro->direccion;
                            $notificacion->save();

                            //notificación bienvenida al empleado
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = Empleado::all()->first()->id;
                            $notificacion->id_empleado_destino = $usuario->empleado->id;
                            $notificacion->titulo = "Bienvenido empleado ". $usuario->empleado->nombre . " " . $usuario->empleado->apellidos;
                            $notificacion->mensaje = "Bienvenido a Emple@Ravel ante todo gracias por utilizar nuestro sistema. En el podras realizar muchas funciones, como gestionar tus jornadas laborales, tu calendario, proyectos y mucho mas. ";
                            $notificacion->save();

                break;

                           
                case 'empleado_centro_actualiza':

                            //notificación administrativa
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = Empleado::all()->first()->id;
                            $notificacion->titulo = "Se ha cambiado de centro productivo al empleado : ". $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . "  al centro productivo : ". $centro->nombre;
                            $notificacion->mensaje = "El empleado : " . $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . " con el rol de : " .$usuario->getRoleNames()->first() . ",  y correo : " . $usuario-> email . " desempeñara el puesto de : " . $usuario->empleado->puesto . " ha sido reubicado en el centro productivo :" .$centro->nombre . " de la localidad : " . $centro->localidad . " con dirección en : " . $centro->direccion;
                            $notificacion->save();

                            //notificación bienvenida al empleado
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = Empleado::all()->first()->id;
                            $notificacion->id_empleado_destino = $usuario->empleado->id;
                            $notificacion->titulo = "Bienvenido empleado ". $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . "  al nuevo centro productivo : ". $centro->nombre;
                            $notificacion->mensaje = "Has sido reasignado a un nuevo centro productivo de la localidad : " . $centro->localidad . " ubicado en : " . $centro->direccion;
                            $notificacion->save();

                break;


                  case 'usuario_rol_actualiza':

                            //notificación administrativa
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = Empleado::all()->first()->id;
                            $notificacion->titulo = "Se ha cambiado de rol al empleado : ". $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . "  al rol : ". $usuario->getRoleNames()->first();
                            $notificacion->mensaje = "Se ha cambiado el al empleado : " . $usuario->empleado->nombre . " " . $usuario->empleado->apellidos . " a el rol de : " .$usuario->getRoleNames()->first() ;
                            $notificacion->save();

                            //notificación bienvenida al empleado
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = Empleado::all()->first()->id;
                            $notificacion->id_empleado_destino = $usuario->empleado->id;
                            $notificacion->titulo = "Nuevo rol asignado ". $usuario->empleado->nombre . " " . $usuario->empleado->apellidos ;
                            $notificacion->mensaje = "Se le ha asignado el nuevo rol de : " . $usuario->getRoleNames()->first();
                            $notificacion->save();

                break;


                case 'centro_actualiza':

                            //notificación administrativa
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = Empleado::all()->first()->id;
                            $notificacion->titulo = "Se ha actualizado el centro productivo : ". $centro->nombre . " por el usuario : ". auth()->user()->empleado->nombre . " " . auth()->user()->empleado->apellidos;
                            $notificacion->mensaje = "Se ha actualizado el centro productivo : " . $centro->nombre . " de la localidad : " . $centro->localidad . " ubicado en : " . $centro->direccion;
                            $notificacion->save();


                break;

                case 'centro_eliminar':

                            //notificación administrativa
                            $notificacion = new Notificacion();
                            $notificacion->id_empleado_origen = auth()->user()->empleado->id;
                            $notificacion->id_empleado_destino = Empleado::all()->first()->id;
                            $notificacion->titulo = "Se ha eliminado el centro productivo : ". $centro->nombre . " por el usuario : ". auth()->user()->empleado->nombre . " " . auth()->user()->empleado->apellidos;
                            $notificacion->mensaje = "Se ha eliminado el centro productivo : " . $centro->nombre . " de la localidad : " . $centro->localidad . " ubicado en : " . $centro->direccion;
                            $notificacion->save();


                break;
            }


        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{

            $evento = Evento::find($id);
            if (Storage::exists($evento->adjunto)) {

               $eliminado = Storage::delete($evento->adjunto);
                

             }
             
            $evento->delete();
            return back()->with('estado', 'eliminado');
        }
        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }
    }    
}
