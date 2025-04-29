@extends('adminlte::page')

@section('title', 'Centro Productivo')

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

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop