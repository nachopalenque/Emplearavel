<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Empleado;
use App\Models\Evento;

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

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }


    public function editProyectoEmpleado($id)
    {
        try{

            $proyecto = Proyecto::find($id);
            $empleadosOcupadosIds = $proyecto->empleados()->pluck('id_empleado')->toArray();
            $empleadosDisponibles = Empleado::whereNotIn('id', $empleadosOcupadosIds)->get();


            return view('Proyecto.edit-emp',['id'=>$id,'empleados'=>$empleadosDisponibles]);

        }catch(Exepcion $e){
        
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

    public function showProyectoEmpleado($id)
    {
        try{

            $proyecto = Proyecto::find($id);
            return view('Proyecto.pr-emp',['empleados'=>$proyecto->empleados]);

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
    
                $proyecto->save();
                session()->flash('estado', 'actualizado');
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

    public function destroyProyectoEmpleado($id)
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


     
}
