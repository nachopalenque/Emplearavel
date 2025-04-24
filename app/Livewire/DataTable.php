<?php

namespace App\Livewire;

use Livewire\Component;

class DataTable extends Component
{
    public $items;
    public $modeloClase;
    public $columNames;
    
    //Método para inicializar variables
    public function mount($items,$modelo, $columNames){

        $this->modeloClase = new $modelo();
        $this->items = $items;
        $this->columNames = $columNames;
    }
    public function render()
    {
        $columnas = $this->modeloClase->getFillable();
        return view('livewire.data-table'
        ,
        [
            'columnas' => $columnas,
            'items' => $this->items,
            'columNames' => $this->columNames
        ]
    );
    }
}
