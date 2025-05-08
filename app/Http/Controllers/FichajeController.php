<?php

namespace App\Http\Controllers;

use App\Models\Fichaje;
use App\Models\User;

use Illuminate\Http\Request;

class FichajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $fichajes = Fichaje::where('id_usuario', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();            
            return view('Fichaje.index', ['fichajes' => $fichajes]);
        }
        catch(Exception $e){

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
    public function storePrint(Request $request){
        try{

        }catch(Exception $e){
            
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Fichaje $fichaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fichaje $fichaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fichaje $fichaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fichaje $fichaje)
    {
        //
    }
}
