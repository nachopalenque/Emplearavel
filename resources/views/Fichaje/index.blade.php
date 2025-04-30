@extends('adminlte::page')

@section('title', 'Listado de Fichajes')

@section('content_header')
    <h1>Listado de fichajes</h1>
@stop

@section('content')
    

@livewire('DataTable',['items' => $fichajes, 'modelo' => 'App\Models\Fichaje','modeloNombre' => 'Fichaje' ,'columNombres' => ['Id','Fecha Inicio','Fecha Fin','Estado', 'Tiempo Fichaje']])



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@push('js')
    @if(session('fichaje') == 'inicio')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                mensajeConfirmacionFichaje(); // asegúrate de que esta función esté definida
            });
        </script>
    @elseif(session('fichaje') == 'fin')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                mensajeConfirmacionFichajeTerminado(); // asegúrate de que esta función esté definida
            });
        </script>
    @endif

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush


@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop