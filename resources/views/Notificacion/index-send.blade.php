@extends('adminlte::page')

@section('title', 'Notificaciones')

@section('content_header')
    <h1>Listado de notificaciones enviadas</h1>
    <hr>
@stop

@section('content')
    

<!--
--livewire('DataTable',['items' => $centros, 'modelo' => 'App\Models\Centro','modeloNombre' => 'Centro' ,
'columNombres' => ['id','Nombre','Razón Social','Dirección','País','Provincia','Localidad','Código Postal','CIF']])

-->


<x-datatable 
    :items="$notificaciones"
    :modelo="\App\Models\Notificacion::class"
    :modeloNombre="'Notificacion'"
    :columNombres="['id','Fecha','Asunto','Origen','Destinatario']"
    :opcional="'notificaciones_enviadas'"
/>




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
            const modalElement = document.getElementById('modalValidaciones');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            document.addEventListener('click', function (e) {
                 if (e.target.closest('#btnCerrarModal')) {
                    location.reload(true);
                }
            })

        

        });
    </script>
@endif

    <script>


       window.addEventListener('DOMContentLoaded', (event) => {

    
            switch(@json(session('estado'))){

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