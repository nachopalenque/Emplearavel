<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Fichaje;
use App\Models\User;

class DataTable extends Component
{
    public $items;
    public $modeloClase;
    public $columNombres;
    public $modeloNombre;


    
    //Método para inicializar variables
    public function mount($items,$modelo,$modeloNombre,$columNombres ){

        $this->modeloClase = new $modelo();
        $this->items = $items;
        $this->columNames = $columNombres;
        $this->modeloNombre = $modeloNombre;
    }
    public function render()
    {
        $columnas = $this->modeloClase->getFillable();
        return view('livewire.data-table'
        ,
        [
            'columnas' => $columnas,
            'items' => $this->items,
            'columNames' => $this->columNombres,
            'modeloNombre' => $this->modeloNombre
        ]
    );
    }

    public function limpiarErrores()
    {
        $this->resetErrorBag(); // Limpia los errores de validación
        $this->resetValidation(); // Limpia el estado de validación
    }

    public function fichar(){


        try{
            Fichaje::create([
                'fecha_inicio' => now(),
                'fecha_fin' => '2025 -04 -29 ??: ??: ??',
                'id_usuario' => auth()->user()->id, // o cualquier ID válido
                'estado' => 'en curso',
                'tiempo_fichaje' => '00:00:00'
            ]);
    
            session()->flash('fichaje', 'inicio');

            return redirect()->route('fichaje.index');
        }
        catch(Exception $e){
            
        }

    }

    public function terminarFichaje($id){
 
        try{
            $fichaje = Fichaje::find($id);
            $diff = now()->diffAsCarbonInterval($fichaje->fecha_inicio);

            $fichaje->fecha_fin = now();
            $fichaje->tiempo_fichaje = $diff->forHumans();
            $fichaje->estado = 'terminado';
            $fichaje->save();
            session()->flash('fichaje', 'fin');

            return redirect()->route('fichaje.index');

        }catch(Exception $e){
            
        }

    }

}
