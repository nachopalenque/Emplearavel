<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{

        //eventos de la base de datos
        $eventos = Evento::all();
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
                'titulo' => 'required',
                'fecha_inicio' => 'required|date|after_or_equal:today',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                'tipo_evento' => 'required',
        
            ]);
    


            $evento = new Evento();
            $evento->titulo = $request->input('titulo');
            $evento->fecha_inicio = $request->input('fecha_inicio');
            $evento->fecha_fin = $request->input('fecha_fin');
            $evento->tipo_evento = $request->input('tipo_evento');
            $evento->observaciones = $request->input('observaciones');
            $evento->estado_evento = 'pendiente';
            $evento->adjunto = '';
            $evento->id_empleado = auth()->user()->empleado->id;

            $evento->save();
            return redirect()->route('evento.index')->with('estado', 'creado');


        }catch(\Exception $e){
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
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
    public function destroy(Evento $evento)
    {
        //
    }
}
