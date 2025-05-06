@extends('adminlte::page')

@section('title', 'Listado de Empleados')

@section('content_header')
    <h1>Listado de empleados</h1>
@stop

@section('content')
    

@livewire('DataTable',['items' => $empleados, 'modelo' => 'App\Models\Empleado','modeloNombre' => 'Empleado' ,'columNombres' => ['id','Seguridad Social','DNI','Nombre','Apellidos','Provincia','Localidad','Código Postal','Dirección','Pais','Puesto', 'Fecha de Creación', 'Fecha de Actualización']])

  

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

@if (session('eliminado') == 'ok')

    <script>

       window.addEventListener('DOMContentLoaded', (event) => {
            mensajeConfirmacionEliminado();
        });
        
      </script>
@endif


@if (session('creado') == 'ok')

    <script>
      
       window.addEventListener('DOMContentLoaded', (event) => {
        mensajeConfirmacionNuevoElemento();
        });
        
      </script>
@endif

@if (session('actualizado') == 'ok')

    <script>
      
       window.addEventListener('DOMContentLoaded', (event) => {
        mensajeConfirmacionActualizacionElemento();
        });
        
      </script>
@endif


@endpush