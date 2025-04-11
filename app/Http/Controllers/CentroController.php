<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use Illuminate\Http\Request;

class CentroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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


    }
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
            return redirect('register');  

    
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(int $id_centro)
    {
        return view('Centro.show');    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Centro $centro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Centro $centro)
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
