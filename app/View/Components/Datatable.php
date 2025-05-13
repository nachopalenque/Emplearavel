<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Datatable extends Component
{
    /**
     * Create a new component instance.
     */

    public $items;
    public $modeloClase;
    public $columNames;
    public $modeloNombre;
    public $columnas;
    public function __construct($items,$modelo,$modeloNombre,$columNombres)
    {
        $this->modeloClase = new $modelo();
        $this->columNames = $columNombres;
        $this->modeloNombre = $modeloNombre;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {        
        $this->columnas = $this->modeloClase->getFillable();
        return view('components.datatable');
    }


      public function limpiarErrores()
    {
        $this->resetErrorBag(); // Limpia los errores de validación
        $this->resetValidation(); // Limpia el estado de validación
    }

   
}
