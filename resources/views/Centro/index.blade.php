@extends('adminlte::page')

@section('title', 'Centro Productivo')

@section('content_header')
    <h1>Listado de centros productivos</h1>
@stop

@section('content')
    

@livewire('DataTable',['items' => $centros, 'modelo' => 'App\Models\Centro','modeloNombre' => 'Centro' ,'columNombres' => ['Id','Nombre','Razón Social','Dirección','País','Provincia','Localidad','Código Postal','CIF']])



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop