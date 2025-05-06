@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
    <h4 class="text-info">Bienvenido  {{ auth()->user()->name }}  !! Nos encanta volver a verte.</h4>
    <hr>
    <p><strong>Tipo de usuario: </strong> <span class="text-maroon">{{ auth()->user()->getRoleNames()->first() }}</span> </p>
    <p><strong>Centro productivo: </strong> <span class="text-maroon">{{ auth()->user()->centro->nombre }}</span></p>
    <x-adminlte-button 
    class="btn-sm bg-gradient-info" 
    type="button" label="Ir al panel de fichajes" 
    icon="fas fa-lg fa-calendar-check"
    onclick="window.location.href='{{ route('fichaje.index') }}'"
    />

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop