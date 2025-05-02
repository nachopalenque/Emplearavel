@extends('adminlte::page')

@section('title', 'Centro Productivo')

@section('content_header')
    <h1>Listado de usuarios del sistema</h1>
@stop

@section('content')
    

@livewire('DataTable',['items' => $usuarios, 'modelo' => 'App\Models\User','modeloNombre' => 'Usuario' ,'columNombres' => ['id','id_centro','Nombre','Email','password','Centro Productivo','Rol','Fecha de creación','Fecha última modificación']])



@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop