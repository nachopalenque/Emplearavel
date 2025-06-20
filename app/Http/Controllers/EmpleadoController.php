<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Evento;
use App\Models\User;

use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public function index()
    {
      try{

        session()->forget('empleado_nombre');
        $empleados = Empleado::paginate(10);
        return view('Empleado.index', ['empleados' => $empleados]);

      }
      catch(\Exception $e){

        return response()->json(['error' => $e->getMessage()], 500);   

      }
    }

     public function indexFiltrar(Request $request)
    {
        try{    
            $empleados = Empleado::where('nombre', 'like', "%{$request->input('nombre')}%")
            ->paginate(10);
            session()->flash('empleado_nombre', $request->input('nombre'));

            return view('Empleado.index', ['empleados' => $empleados]);
        }
        catch(Exception $e){

             return response()->json(['error' => $e->getMessage()], 500);

        }
    
    }
    public function showFiltrar()
    {
        try{
            return view('Empleado.show-filter');

        }catch(Exepcion $e){
        
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_empleado)
    {
        try{
            $empleado = Empleado::find($id_empleado);
            return view('Empleado.show', ['empleado' => $empleado]);

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);           }
    }

        public function showDocs()
    {
        try{
            $documentos = Evento::where('id_empleado', auth()->user()->empleado->id)
            ->where('adjunto', '!=', '')
            ->whereNull('id_proyecto') 
            ->select('id','adjunto')
            ->paginate(10);
            return view('Empleado.show-intranet', ['documentos' => $documentos]);

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);        }
    }


    public function showAuth()
    {
        try{

            return $this->show(auth()->user()->empleado->id);

        }catch(\Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_empleado)
    {
        try{

            $empleado = Empleado::find($id_empleado);
            return view('Empleado.edit', ['empleado' => $empleado]);


        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       try{

        $validacion = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'direccion' => 'required',
            'pais' => 'required',
            'provincia' => 'required',
            'localidad' => 'required',
            'codigo_postal' => 'required|max:5',
            'telefono' => 'required|max:15',
            'puesto' => 'required',
            

        ]);

        $empleado = Empleado::find($request->id);

        $empleado->nombre = $request->input('nombre');
        $empleado->apellidos = $request->input('apellidos');
        $empleado->provincia = $request->input('provincia');
        $empleado->localidad = $request->input('localidad');
        $empleado->codigo_postal = $request->input('codigo_postal');
        $empleado->direccion = $request->input('direccion');
        $empleado->pais = $request->input('pais');
        $empleado->telefono = $request->input('telefono');
        $empleado->puesto = $request->input('puesto');
        $empleado->save();
        
        return redirect()->route('empleado.show', $empleado->id)->with('estado', 'actualizado');


       }catch(\Exception $e){

          return response()->json(['error' => $e->getMessage()], 500);   
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        //
    }

    public function storePrincipal(Request $request)
    {
        try{



            $validacion = $request->validate([
                'nombre' => 'required',
                'apellidos' => 'required',
                'dni' => 'required|max:9|unique:empleados,dni',
                'direccion' => 'required',
                'pais' => 'required',
                'provincia' => 'required',
                'localidad' => 'required',
                'codigo_postal' => 'required|max:5',
                'telefono' => 'required|max:15',
                'seguridad_social' => 'required|max:15|unique:empleados,seguridad_social',
                'puesto' => 'required',
                

            ]);

            $empleado = new Empleado();
            $empleado->provincia = $request->input('provincia');
            $empleado->localidad = $request->input('localidad');
            $empleado->codigo_postal = $request->input('codigo_postal');
            $empleado->direccion = $request->input('direccion');
            $empleado->seguridad_social = $request->input('seguridad_social');
            $empleado->pais = $request->input('pais');
            $empleado->dni = $request->input('dni');
            $empleado->nombre = $request->input('nombre');
            $empleado->apellidos = $request->input('apellidos');
            $empleado->telefono = $request->input('telefono');
            $empleado->puesto = $request->input('puesto');
            $empleado->id_usuario = $request->input('id_usuario');
            $empleado->save();

            return redirect()->route('centro-asociar-usuario');

        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }

    public function createPrincipal()
    {
        try{

            $usuarioAuth = User::find(auth()->user()->id);

            if($usuarioAuth->empleado()->count() > 0){
                return redirect('dashboard');  
            }else{
                
                return view('Empleado.main-create');

            }


        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }
}
