@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Inicio</h1>
    <hr>
@stop

@section('content')

@php

Use App\Http\Controllers\NotificacionController;

    if (auth()->check() && auth()->user()->empleado && auth()->user()->empleado->id !== null) {
        $numNotificaciones = NotificacionController::numNotificacionesNoLeidas();
        $usuario = auth()->user()->name ;
        $rol = auth()->user()->getRoleNames()->first();
        $centro = auth()->user()->centro->nombre;
        $ciudad = auth()->user()->empleado->localidad;
    }else{
        $numNotificaciones = 0;
        $usuario = '';
        $rol = '';
        $centro = '';
        $ciudad = '';
    }

@endphp
    <div id="welcome" class="card">
        <div class="card-body text-left">
                <p class="text-white display-5">Bienvenido  {{ $usuario}}  !! Estamos encantados de volver a verte.</p>
             <div id="contentCLima"></div>
        </div>
    </div>
    <hr>
    <div class="card-body bg-gradient-navy text-left">
    <p><strong>Tipo de usuario: </strong> <span class="text-maroon">{{ $rol }}</span> </p>
    <p><strong>Centro productivo: </strong> <span class="text-maroon">{{ $centro }}</span></p>
    <p><strong>Número de notificaciones sin leer: </strong> <span class="text-maroon">{{ $numNotificaciones  }}</span></p>
    <x-adminlte-button 
    class="btn-sm bg-gradient-olive" 
    type="button" label="Ir a la bandeja de notificaciones" 
    icon="fas fa-lg fa-bell"
    onclick="window.location.href='{{ route('notificacion.index') }}'"
    />
    <x-adminlte-button 
    class="btn-sm bg-gradient-info" 
    type="button" label="Ir al panel de fichajes" 
    icon="fas fa-lg fa-calendar-check"
    onclick="window.location.href='{{ route('fichaje.index') }}'"
    />
        <x-adminlte-button 
    class="btn-sm bg-gradient-maroon" 
    type="button" label="Ver manual de usuario" 
    icon="fas fa-lg fa-book"
    onclick="window.open('{{ route('ver.manual.usuario') }}', '_blank')"
   />

    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> 
    
    /*
        Escuchamos el evento de carga del dom y declaramos dos constantes, una para la ciudad (usando la directiva de blade json guardamos en la constante el valor de la ciudad del empleado autentificado) y otra para la api key (la api key la tenemos guardada en una variable de entorno .env que esta implementada den config/services y se denomina api_clima y de ahi tenemos la clave key)
        una vez declaradas las constantes usamos fetch a la api openweathermap para obtener el clima de la ciudad del empleado autentificado y mostrarlo en el div con id contentCLima.
        Implementamos un switch para segun el valor del campo main del json que nos devuelve la api poder mostrar el icono correspondiente al clima
        Consideraciones: hay que restar 273.15 a la temperatura para que quede en grados celcius ya que la api devuelve grados kelvin
        además uso math.trunc para darle un formato entero a la temperatura sin redondeos

    */
    
    window.addEventListener('DOMContentLoaded', (event) => {
        
            const ciudad = @json($ciudad);
            const apiKey = @json(config('services.api_clima.key'));

             fetch(`https://api.openweathermap.org/data/2.5/weather?q=${ciudad}&APPID=${apiKey}`)
                  .then(res => res.json())
                  .then(data => {
                      console.log(data);
                      switch(data.weather[0].main){
                        
                          case 'Clouds':
                              document.getElementById('contentCLima').innerHTML = `<h3>Hoy el clima en ${data.name} es de ${Math.trunc(data.main.temp_max-273.15)} grados y mayormente nublado <img src="https://cdn-icons-png.flaticon.com/512/1163/1163763.png" with="50px" height="50px" alt=""> </h3> `;
                              limpiarClases();
                              document.getElementById('welcome').classList.add('bg-gradient-secondary');
                              break;      
                          case 'Rain':
                              document.getElementById('contentCLima').innerHTML = `<h3>Hoy el clima en ${data.name} es de ${Math.trunc(data.main.temp_max-273.15)} grados con lluvia  <img src="https://cdn-icons-png.flaticon.com/512/4834/4834585.png" with="50px" height="50px" alt=""></h3>`;
                              limpiarClases();
                              document.getElementById('welcome').classList.add('bg-gradient-navy');
                              break;
                          case 'Snow':
                              document.getElementById('contentCLima').innerHTML = `<h3>Hoy el clima en ${data.name} es de ${Math.trunc(data.main.temp_max-273.15)} grados con nieve <img src="https://cdn-icons-png.flaticon.com/512/3730/3730830.png" with="50px" height="50px" alt=""></h3>`;
                              limpiarClases();
                              document.getElementById('welcome').classList.add('bg-gradient-info');
                              break;      
                          case 'Clear':
                              document.getElementById('contentCLima').innerHTML = `<h3>Hoy el clima en ${data.name} es de ${Math.trunc(data.main.temp_max-273.15)} grados con sol <img src="https://cdn-icons-png.flaticon.com/512/16115/16115959.png" with="50px" height="50px" alt=""></h3>`;
                              limpiarClases();
                              document.getElementById('welcome').classList.add('bg-gradient-warning');
                              break;
                          default:
                              document.getElementById('contentCLima').innerHTML = `<h3>Hoy el clima en ${data.name} es de ${Math.trunc(data.main.temp_max-273.15)} grados</h3>`;
                              break;
                      }
            
                  });




    })
    
    function limpiarClases(){
        document.getElementById('welcome').classList.remove(
    'bg-gradient-navy', 'bg-gradient-secondary', 'bg-gradient-warning', 'bg-gradient-info',

    );
    }
    </script>
@stop