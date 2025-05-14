@extends('adminlte::page')

@section('title', 'Centro Productivo')

@section('content_header')
    <h1>Listado de usuarios del sistema</h1>
    <hr>
@stop

@section('content')
    
<!--
--livewire('DataTable',['items' => $usuarios, 'modelo' => 'App\Models\User','modeloNombre' => 'Usuario' ,
'columNombres' => ['id','id_centro','Nombre','Email','password','Centro Productivo','Rol','Fecha de creación','Fecha última modificación']])

-->

<x-datatable 
    :items="$usuarios"
    :modelo="\App\Models\User::class"
    :modeloNombre="'Usuario'"
    :columNombres="['id','id_centro','Nombre','Email','password','Centro Productivo','Rol','Fecha de creación','Fecha última modificación']"
/>



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop


@push('js')

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
            mensajeConfirmacionEliminado();
            break;
            
            }

        });
        
      </script>


@endpush
