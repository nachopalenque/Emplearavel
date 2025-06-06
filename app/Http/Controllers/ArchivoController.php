<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Evento;
use App\Models\Proyecto;

class ArchivoController extends Controller
{


    public function descargaArchivoEmpleado($id)
    {
        try{

            $evento = Evento::find($id);
            if(auth()->user()->empleado->id == $evento->id_empleado){
                
                return Storage::disk('local')->download($evento->adjunto);

            }else{

                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no tiene permisos para acceder a este recurso.']);

            }


        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

        public function verArchivoEmpleado($id)
    {
        try{

            $evento = Evento::find($id);
            if(auth()->user()->empleado->id == $evento->id_empleado){
                
            return response()->file(storage_path('app/' . $evento->adjunto));

            }else{

                return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no tiene permisos para acceder a este recurso.']);

            }


        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }



    public function descargaArchivoProyecto($id)
    {
        try{

            //buscamos el evento con el archivo adjunto por el parametro id
            $evento = Evento::find($id);
            //si el usuario autentificado es rol Administrador podemos descargar el archivo
            if(PermisosController::authAdmin()){
                
                return Storage::disk('local')->download($evento->adjunto);

            }else{

                //Para evitar el intento de acceso por url: Si por el contrario no es rol administrador, consultamos si dicho usuario autentificado esta incluido en el proyecto y descargamos el archivo. Si no redirigimos a la vista de advertencia
                if(proyectoEmpleado($evento->id_proyecto)){
                
                return Storage::disk('local')->download($evento->adjunto);

                }
                else{

                    return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no tiene permisos para acceder a este recurso.']);

               
                }


            }


        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

        
        public function verArchivoProyecto($id)
    {
        try{

            //buscamos el evento con el archivo adjunto por el parametro id
            $evento = Evento::find($id);

             //si el usuario autentificado es rol Administrador podemos ver el archivo
            if(PermisosController::authAdmin()){

                return response()->file(storage_path('app/' . $evento->adjunto));

            }else{


               //Para evitar el intento de acceso por url: Si por el contrario no es rol administrador, consultamos si dicho usuario autentificado esta incluido en el proyecto y ver el archivo. Si no redirigimos a la vista de advertencia
                if($this->proyectoEmpleado($evento->id_proyecto)){
                
                    return response()->file(storage_path('app/' . $evento->adjunto));

                }
                else{

                    return view('Mensaje.advertencia', ['titulo' => 'Operación no disponible', 'mensaje' => 'Este usuario no tiene permisos para acceder a este recurso.']);
               
                }

            }
          


        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }


    //a esta función le pasamos el id del proyecto y nos devuelve si el empleado autentificado esta incluido en dicho proyecto mediante true o false
    public function proyectoEmpleado($id){

        try{

            $proyecto = Proyecto::find($id);
            return  $existe = $proyecto->empleados()->where('id_empleado', auth()->user()->empleado->id)->exists();

        }catch(Exception $e){
            
            return response()->json(['error' => $e->getMessage()], 500);           
        }
    }
}
