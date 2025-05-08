@extends('adminlte::page')

@section('title', 'Centro Productivo')

@section('content_header')
    <h1>Listado de centros productivos</h1>
@stop

@section('content')
    

@livewire('DataTable',['items' => $centros, 'modelo' => 'App\Models\Centro','modeloNombre' => 'Centro' ,'columNombres' => ['id','Nombre','Razón Social','Dirección','País','Provincia','Localidad','Código Postal','CIF']])



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@push('js')
<!--   aquí lo que hago es que me muestre el modal de nuevo si hay errores de validación -->
@if ($errors->any())

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalElement = document.getElementById('modalNuevo');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        });
    </script>
@endif

    <script>


       window.addEventListener('DOMContentLoaded', (event) => {

            let estado = @json(session('estado'));

            switch(estado){

            case 'creado':
            mensajeConfirmacionNuevoElemento();
            break;

            case 'actualizado':
            mensajeConfirmacionActualizacionElemento();
            break;
            
            case 'eliminado':
            mensajeConfirmacionEliminacionElemento();
            break;
            }

        });
        
      </script>




@endpush