<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Http\Controllers\PermisosController;
use App\Models\User;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centros = Centro::all();
        return view('Centro.index', ['centros' => $centros]);
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

        try {

            $validacion = $request->validate([
                'nombre' => 'required | unique:centros',
                'razon_social' => 'required',
                'CIF' => 'required',
                'direccion' => 'required',
                'pais' => 'required',
                'provincia' => 'required',
                'localidad' => 'required',
                'codigo_postal' => 'required',
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

            return back();
    
            //return redirect()->route('centro.index');
           
        } catch (Exception $e) {

            Log::error($e->getMessage());
            return redirect()->route('centro.index');
        }
    


    }

    //esta función se llamara únicamentela primera vez que se cree un Centro Productivo
    public function storePrincipal(Request $request)
    {
        $centros = Centro::all();
        
        if(count($centros) == 0){

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


    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_centro)
    {
        $centro = Centro::find($id_centro);
        return view('Centro.show', ['centro' => $centro]);    
    }

    public function showAuth(){

        //Si el usuario autentificado es Administrador podemos ver y administrar todos los centros
        if(auth()->user()->getRoleNames()->first() == 'Administrador'){

            return $this->index();
            
        }else{

            //por el contrario si es un usuario normal solo podemos ver el centro al que pertenece
            $centro = Centro::find(auth()->user()->id_centro);
            return view('Centro.show', ['centro' => $centro]);

        }

    }

    public function showUserCentro(){
        
        $usuario = User::find(auth()->user()->id);

        if($usuario->id_centro != null){

            return redirect('dashboard');  

        }else{

            $centros = Centro::all();
            return view('Centro.edit-user', ['centros' => $centros, 'usuario' => $usuario]);


        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $centro = Centro::find($id);
        return view('Centro.edit', ['centro' => $centro]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Centro $centro)
    {
        //
    }
    
    public function centroPrincipal(){
        
        $centro = Centro::all();

        if(count($centro) == 0){

            return view('Centro.main-create');
        }
        else{

            return redirect('register');  
        }


    }
}
