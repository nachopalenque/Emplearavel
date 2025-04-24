<?php

namespace App\Livewire;

use Livewire\Component;

class DataTable extends Component
{
    public $items;
    public $modeloClase;
    
    //Método para inicializar variables
    public function mount($items,$modelo){

        $this->modeloClase = new $modelo();
        $this->items = $items;
    }
    public function render()
    {
        $columnas = $this->modeloClase->getFillable();
        return view('livewire.data-table'
        ,
        [
            'columnas' => $columnas,
            'items' => $this->items,
        ]
    );
    }
}
