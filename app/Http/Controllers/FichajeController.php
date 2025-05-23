<?php

namespace App\Http\Controllers;

use App\Models\Fichaje;
use App\Models\Empleado;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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
            ->paginate(10);  
            return view('Fichaje.index', ['fichajes' => $fichajes]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function indexPrint(Request $request){
        try{

            return view('Fichaje.print');

        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }
    public function storePrint(Request $request){
        try{

            $fecha_inicio = $request->input('fecha_inicio');
            $fecha_fin = $request->input('fecha_fin');
            $empleado = auth()->user()->empleado->nombre . ' ' . auth()->user()->empleado->apellidos;
            $dni = auth()->user()->empleado->dni;
            $seguridad_social = auth()->user()->empleado->seguridad_social;
            $razon_social = auth()->user()->centro->razon_social;
            $cif = auth()->user()->centro->CIF;

            $fichajes = Fichaje::where('id_usuario', auth()->user()->id)
                    ->where('fecha_inicio', '>=', $fecha_inicio)
                    ->where('fecha_fin', '<=', $fecha_fin)
                    ->get();

            return $this->generarPDF('Fichaje.print-create', ['fichajes' => $fichajes , 'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin, 'empleado' => $empleado, 'dni' => $dni, 'seguridad_social' => $seguridad_social, 'razon_social' => $razon_social, 'cif' => $cif]);      

            //return view('Fichaje.print-create', ['fichajes' => $fichajes , 'fecha_inicio' => $fecha_inicio, 'fecha_fin' => $fecha_fin, 'empleado' => $empleado, 'dni' => $dni, 'seguridad_social' => $seguridad_social, 'razon_social' => $razon_social, 'cif' => $cif]);        

        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }

        public function generarPDF($vista,$datos)
    {
       try{
            $pdf = Pdf::loadView($vista , $datos);

            return $pdf->stream('listado-de-fichajes.pdf');

       }catch(Exception $e){
           
          return response()->json(['error' => $e->getMessage()], 500);   
       }

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $empleado = Empleado::find($id);
            $fichajes = Fichaje::where('id_usuario', $empleado->id_usuario)
            ->orderBy('id', 'desc')
            ->paginate(10);  
            return view('Fichaje.show', ['fichajes' => $fichajes]);
        }
        catch(Exception $e){

            return response()->json(['error' => $e->getMessage()], 500);   
        }
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

     public function fichar(){


        try{
            Fichaje::create([
                'fecha_inicio' => now(),
                'fecha_fin' => now(),
                'id_usuario' => auth()->user()->id, // o cualquier ID válido
                'estado' => 'en curso',
                'tiempo_fichaje' => '00:00:00'
            ]);
    
            session()->flash('fichaje', 'inicio');

            return redirect()->route('fichaje.index');
        }
        catch(Exception $e){
            
          return response()->json(['error' => $e->getMessage()], 500);   
        }

    }

    public function terminarFichar(){
 
        try{
            $fichaje = Fichaje::where('id_usuario', auth()->id())
                ->where('estado', 'en curso')
                ->orderBy('id', 'desc')
                ->first();
            $diff = now()->diffAsCarbonInterval($fichaje->fecha_inicio);
            $fichaje->fecha_fin = now();
            $fichaje->tiempo_fichaje = $diff->forHumans();
            $fichaje->estado = 'terminado';
            $fichaje->save();
            session()->flash('fichaje', 'fin');

            return redirect()->route('fichaje.index');

        }catch(Exception $e){
          
          return response()->json(['error' => $e->getMessage()], 500);   
          
        }

    }

}
