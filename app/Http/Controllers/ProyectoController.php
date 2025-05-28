<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Empleado;
use App\Models\Evento;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PermisosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $authRol = PermisosController::authRol();
            session()->forget('proyectos_nombre');
            session()->forget('proyectos_estado');

            switch ($authRol) {
                case 'Administrador':
                    $proyectos = Proyecto::paginate(10);
                break;

                case 'ProductManager':
                    $proyectos = Proyecto::paginate(10);
                break;

                case 'Usuario':
                    $proyectos = Proyecto::whereHas('empleados', function ($query) {
                        $query->where('id_empleado', auth()->user()->empleado->id);
                    })->paginate(10);                
                break;
            }

            return view('Proyecto.index', ['proyectos' => $proyectos]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }

    }

       public function indexFiltrar(Request $request)
    {
        try{
            $authRol = PermisosController::authRol();

            switch ($authRol) {
                case 'Administrador':
                    $proyectos = Proyecto::where('nombre', 'like', "%{$request->input('nombre')}%")
                    ->paginate(10);
                break;

                case 'ProductManager':
                    $proyectos = Proyecto::where('nombre', 'like', "%{$request->input('nombre')}%")
                    ->paginate(10);                
                break;

                case 'Usuario':
                    $proyectos = Proyecto::whereHas('empleados', function ($query) {
                        $query->where('id_empleado', auth()->user()->empleado->id);
                    })
                    ->where('nombre', 'like', "%{$request->input('nombre')}%")
                    ->paginate(10);                
                break;
            }
            
            session()->flash('proyectos_nombre', $request->input('nombre'));
            return view('Proyecto.index', ['proyectos' => $proyectos]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }

    }

        public function indexFiltrarEstado($estado)
    {
        try{
            $authRol = PermisosController::authRol();

            switch ($authRol) {
                case 'Administrador':
                    $proyectos = Proyecto::where('estado', $estado)
                    ->paginate(10);
                break;

                case 'ProductManager':
                    $proyectos = Proyecto::where('estado', $estado)
                    ->paginate(10);
                break;

                case 'Usuario':
                    $proyectos = Proyecto::whereHas('empleados', function ($query) {
                        $query->where('id_empleado', auth()->user()->empleado->id);
                    })
                    ->where('estado', $estado)->paginate(10);                
                break;
            }

            session()->flash('proyectos_estado', $estado);
            return view('Proyecto.index', ['proyectos' => $proyectos]);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }

    }

    public function showDocs($id)
    {
        try{
            $documentos = Evento::where('id_proyecto', $id)
            ->where('adjunto', '!=', '')
            ->select('id','adjunto')
            ->paginate(10);
            return view('Proyecto.show-intranet', ['id'=> $id,'documentos' => $documentos]);

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createEvent($id)
    {
        try{

            $proyecto = Proyecto::find($id);
            $empleadosDelProyecto = $proyecto->empleados()->get();            
            return view('Proyecto.create-event', ['id'=> $id ,'empleados' => $empleadosDelProyecto]);

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeEvent(Request $request)
    {
        try{

            $validacion = $request->validate([
                    'titulo' => 'required',
                    'fecha_inicio' => 'required|date|after_or_equal:today',
                    'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                    'adjunto' => 'file|mimes:jpg,png,pdf,docx|max:2048',
            
                ]);
        

            $proyecto = Proyecto::find($request->input('id_proyecto'));
            $evento = new Evento();
            $evento->id_empleado = $request->input('empleado');
            $evento->id_proyecto = $proyecto->id;
            $evento->titulo = $request->input('titulo');
            $evento->fecha_inicio = $request->input('fecha_inicio');
            $evento->fecha_fin = $request->input('fecha_fin');
            $evento->tipo_evento = 'Tarea proyecto';
            $evento->observaciones = $request->input('observaciones');
            $evento->estado_evento = 'Pendiente';
            $evento->adjunto = '';


            //Guardando el adjunto en la carpeta del proyecto en la intranet documental.
            if ($request->hasFile('adjunto')) {

                    $nombreOriginal = $request->file('adjunto')->getClientOriginalName(); 
                    $ruta = $request->file('adjunto')->storeAs($proyecto->intranet.'/'.$nombreOriginal);
                    $evento->adjunto = $proyecto->intranet.'/'.$nombreOriginal;

            }

            $evento->save();
            EventoController::createNotificacionEvent('evento_empleado_tarea', $evento);

            return redirect()->route('proyecto.index')->with('estado', 'creado');


        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

                $validacion = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'fecha_fin' => 'required|date|after_or_equal:today',
                'empleados' => 'required',
               
                ]
        
        );
            $proyecto = new Proyecto();
            $proyecto->nombre = $request->input('nombre');
            $proyecto->fecha_fin = $request->input('fecha_fin');
            $proyecto->descripcion = $request->input('descripcion');
            $proyecto->estado = 'Pendiente';
            $proyecto->save();
            $proyecto->intranet = 'intranet/'.auth()->user()->centro->nombre.'/proyectos/'.'proyecto-'.$proyecto->id;
            $proyecto->save();

            $proyecto->empleados()->attach($request->input('empleados'));

            Storage::disk('local')->makeDirectory('intranet/'.auth()->user()->centro->nombre.'/proyectos/'.'proyecto-'.$proyecto->id);

            return redirect()->route('proyecto.index')->with('estado', 'creado');

        }catch(Exception $e){

        return response()->json(['error' => $e->getMessage()], 500);   

        }
    }

        public function storeProyectoEmpleado($id_proyecto, $id_empleado)
    {
      try{

            $proyecto = Proyecto::find($id_proyecto);
            $proyecto->empleados()->attach($id_empleado);
            return redirect()->route('proyecto.index')->with('estado', 'creado');
        }
        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }   

     }


    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

   public function showFiltrar()
    {
        try{

            return view('Proyecto.show-filter');

        }catch(Exepcion $e){
        
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function editProyectoEmpleado($id)
    {
        try{

            $empleadosOcupadosIds = $this->empleadosProyecto($id);
            $empleadosDisponibles = $this->empleadosDisponibles($empleadosOcupadosIds);


            return view('Proyecto.edit-emp',['id'=>$id,'empleados'=>$empleadosDisponibles]);

        }catch(Exepcion $e){
        
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }


    //Esta función devuelve un array con los id de los empleados que estan ocupados en el proyecto pasado por parámetro
    public function empleadosProyecto($id){

        try{

            $proyecto = Proyecto::find($id);
            $empleadosDelProyecto = $proyecto->empleados()->pluck('id_empleado')->toArray();
            return $empleadosDelProyecto;

        }catch(Exepcion $e){
        
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    /*Esta función devuelve un array con los empleados que no estan ocupados en el proyecto pasado por parámetro.
    El parámetro sera un array con los id de los empleados que estan ocupados en el proyecto
    */
    public function empleadosDisponibles($empleadosDelProyectoIds){
        try{

            $empleadosDisponibles = Empleado::whereNotIn('id', $empleadosDelProyectoIds)->get();
            return $empleadosDisponibles;

        }catch(Exepcion $e){
        
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showProyectoEmpleado($id)
    {
        try{

            $proyecto = Proyecto::find($id);
            return view('Proyecto.pr-emp',['id'=>$id,'empleados'=>$proyecto->empleados]);

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

            $rol = PermisosController::authRol();

            if($rol=='Administrador' || $rol=='ProductManager'){

                $proyecto = Proyecto::find($id);
                return view('Proyecto.edit', ['proyecto' => $proyecto]);

            }else{
                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no puede editar un proyecto. Pongase en contacto con su administrador.']);
            }

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        
          try{

            $rol = PermisosController::authRol();

            if($rol=='Administrador' || $rol=='ProductManager'){


            $validacion = $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'estado' => 'required',
                'fecha_fin' => 'required|date|after_or_equal:today',
            ]);

                $proyecto = Proyecto::find($id);
                $proyecto->nombre = $request->input('nombre');
                $proyecto->descripcion = $request->input('descripcion');
                $proyecto->estado = $request->input('estado');
                $proyecto->fecha_fin = $request->input('fecha_fin');
                $proyecto->progreso_proyecto = $request->input('progreso_proyecto');
                $proyecto->save();
                session()->flash('estado', 'actualizado');
                EventoController::createNotificacionEvent('evento_proyecto_actualizar', null, null, null, $proyecto);
                return redirect()->route('proyecto.index');


            }else{

                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no puede editar un proyecto. Pongase en contacto con su administrador.']);

            }

        }
        catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);

        }  


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      try{

            $proyecto = Proyecto::find($id);
            if (Storage::exists($proyecto->intranet)) {
                Storage::deleteDirectory($proyecto->intranet);
             }
            $proyecto->delete();
            return redirect()->route('proyecto.index')->with('estado', 'eliminado');
        }
        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }   

     }

    public function destroyProyectoEmpleado($id_proyecto, $id_empleado)
    {
      try{

            $proyecto = Proyecto::find($id_proyecto);
            $proyecto->empleados()->detach($id_empleado);
            return redirect()->route('proyecto.index')->with('estado', 'eliminado');
        }
        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }   

     }


     
}
