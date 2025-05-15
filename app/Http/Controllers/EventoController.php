<?php

namespace App\Http\Controllers;

use App\Models\Evento;
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

            Log::error($e->getMessage());
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
                'titulo' => 'required',
                'fecha_inicio' => 'required|date|after_or_equal:today',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                'tipo_evento' => 'required',
                'adjunto' => 'file|mimes:jpg,png,pdf,docx|max:2048',

        
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


         if ($request->hasFile('adjunto')) {
            $nombreOriginal = $archivo->getClientOriginalName(); 

            // Guardar en una carpeta personalizada dentro de `storage/app`
            $ruta = $request->file('adjunto')->storeAs('intranet/'.auth()->user()->centro->nombre.'/empleados/'.auth()->user()->empleado->nombre, $nombreOriginal);

            // Obtener URL accesible (si usas `storage:link`)
            $url = Storage::url($ruta);

            // Puedes guardar $url en la base de datos, por ejemplo:
            // Documento::create(['archivo_url' => $url]);
            
            $evento->adjunto = $url;
        }




            $evento->save();
            return redirect()->route('evento.index')->with('estado', 'creado');


        }catch(\Exception $e){

            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);

            
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
