<?php

namespace App\Livewire;

use Livewire\Component;

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





}
