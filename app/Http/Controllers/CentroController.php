<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\EventoController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CentroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{    
            $centros = Centro::paginate(10);
            return view('Centro.index', ['centros' => $centros]);
        }
        catch(Exception $e){

             return response()->json(['error' => $e->getMessage()], 500);

        }
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{

            return view('Centro.create');

        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validacion = $request->validate([
                'nombre' => 'required | unique:centros',
                'razon_social' => 'required',
                'CIF' => 'required|max:9',
                'direccion' => 'required',
                'pais' => 'required',
                'provincia' => 'required',
                'localidad' => 'required',
                'codigo_postal' => 'required|max:5',
            ]);

            //creando directorios raiz de carpetas para cada centro
            Storage::disk('local')->makeDirectory('intranet/'.$request->input('nombre'));
            Storage::disk('local')->makeDirectory('intranet/'.$request->input('nombre').'/empleados');
            Storage::disk('local')->makeDirectory('intranet/'.$request->input('nombre').'/proyectos');

            $centro = new Centro();
            $centro->nombre = $request->input('nombre');
            $centro->razon_social = $request->input('razon_social');
            $centro->CIF = $request->input('CIF');
            $centro->direccion = $request->input('direccion');
            $centro->pais = $request->input('pais');
            $centro->provincia = $request->input('provincia');
            $centro->localidad = $request->input('localidad');
            $centro->codigo_postal = $request->input('codigo_postal');
            $centro->estilo = $request->input('estilo');
    
            $centro->save();

            EventoController::createNotificacionEvent('evento_centro_productivo_nuevo', null, $centro);
            session()->flash('estado', 'creado');


            return back();
    
            //return redirect()->route('centro.index');
           
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    


    }

    //esta función se llamara únicamentela primera vez que se cree un Centro Productivo
    public function storePrincipal(Request $request)
    {
        try{

            $centros = Centro::all();
        
            if(count($centros) == 0){



            $validacion = $request->validate([
                'nombre' => 'required | unique:centros',
                'razon_social' => 'required',
                'CIF' => 'required|max:9',
                'direccion' => 'required',
                'pais' => 'required',
                'provincia' => 'required',
                'localidad' => 'required',
                'codigo_postal' => 'required|max:5',
            ]);
    



                $centro = new Centro();
                $centro->nombre = $request->input('nombre');
                $centro->razon_social = $request->input('razon_social');
                $centro->CIF = $request->input('CIF');
                $centro->direccion = $request->input('direccion');
                $centro->pais = $request->input('pais');
                $centro->provincia = $request->input('provincia');
                $centro->localidad = $request->input('localidad');
                $centro->codigo_postal = $request->input('codigo_postal');
                $centro->estilo = $request->input('estilo');
                $centro->save();
                //tras guardar el centro productivo incial creamos los roles y permisos del sistema
                PermisosController::plantillaRolesPermisos();
                return redirect('register');  
    
        
            }else{
    
                return view('Mensaje.advertencia', ['Operación no disponible' => $titulo, 'Este usuario no puede crear un Centro Productivo. Pongase en contacto con su administrador.' => $mensaje]);
            }

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);

        }



    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_centro)
    {
        try{

            $centro = Centro::find($id_centro);
            return view('Centro.show', ['centro' => $centro]);    

        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }

    }

    public function showAuth(){

        /*Si el usuario autentificado es Administrador podemos ver y administrar todos los centros
  
        */

        try{

            if(PermisosController::authAdmin()){

                return $this->index();


            }else{

                $centro = Centro::find(auth()->user()->id_centro);
                return view('Centro.show', ['centro' => $centro]);


            }

        }
        catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);
            
        }



    }

    public function showUserCentro(){

        try{

            $usuario = User::find(auth()->user()->id);

            if($usuario->id_centro != null){
    
                return redirect('dashboard');  
    
            }else{
    
                $centros = Centro::all();
                return view('Centro.edit-user', ['centros' => $centros, 'usuario' => $usuario]);
    
    
            }


        }
        catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        try{

            if(PermisosController::authAdmin()){

                $centro = Centro::find($id);
                return view('Centro.edit', ['centro' => $centro]);

            }else{
                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no puede editar un Centro Productivo. Pongase en contacto con su administrador.']);
            }

        }catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);

        }


        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try{

            if(PermisosController::authAdmin()){


            $validacion = $request->validate([
                'nombre' => 'required',
                'razon_social' => 'required',
                'CIF' => 'required|max:9',
                'direccion' => 'required',
                'pais' => 'required',
                'provincia' => 'required',
                'localidad' => 'required',
                'codigo_postal' => 'required|max:5',
            ]);

                $centro = Centro::find($id);
                $centro->nombre = $request->input('nombre');
                $centro->razon_social = $request->input('razon_social');
                $centro->CIF = $request->input('CIF');
                $centro->direccion = $request->input('direccion');
                $centro->pais = $request->input('pais');
                $centro->provincia = $request->input('provincia');
                $centro->localidad = $request->input('localidad');
                $centro->codigo_postal = $request->input('codigo_postal');
                $centro->estilo = $request->input('estilo');
                $centro->save();
                session()->flash('estado', 'actualizado');
                return redirect()->route('centro.index');

            }else{

                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no puede editar un Centro Productivo. Pongase en contacto con su administrador.']);

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

            $centros = Centro::all();


            if(PermisosController::authAdmin()){        

                if(count($centros) == 1){

                    return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Solo existe un centro de trabajo y no puede ser eliminado.']);

                }else{

                    $centro = Centro::find($id);
                    //borrando directorio de carpetas
                    Storage::disk('local')->deleteDirectory('intranet/'.$centro->nombre);
                    $centro->delete();
                    session()->flash('estado', 'eliminado');
    
                    return back();
                    
                }

    
            }else{

                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no puede eliminar un Centro Productivo. Pongase en contacto con su administrador.']);

            }
        }
        catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    
    public function centroPrincipal(){

        try{

               
        $centro = Centro::all();

        if(count($centro) == 0){

            return view('Centro.main-create');
        }
        else{

            return redirect('register');  
        }


        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }
     


    }
}
