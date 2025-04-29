@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
    <p>Bienvenido {{ auth()->user()->getRoleNames()->first() }} {{ auth()->user()->name }}  </p>
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