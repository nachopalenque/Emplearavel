<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
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
            $proyecto->intranet = 'intranet/'.auth()->user()->centro->nombre.'/proyectos/'.$proyecto->nombre;
            $proyecto->save();
            
            $proyecto->empleados()->attach($request->input('empleados'));

            Storage::disk('local')->makeDirectory('intranet/'.auth()->user()->centro->nombre.'/proyectos/'.$proyecto->nombre);

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        //
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
}
