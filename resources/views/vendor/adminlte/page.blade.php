@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')
@vite('resources/js/app.js')

@section('adminlte_css')

    @stack('css')
    @yield('css')
@stop

@php
//cargo el estilo del centro

use App\Models\Centro;


if (auth()->check() && auth()->user()->empleado && auth()->user()->empleado->id !== null) {

$user = auth()->user();
$centro = Centro::find($user->id_centro);


switch ($centro->estilo){
    case 'light':

        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary elevation-4');
        Config::set('adminlte.classes_topnav', 'navbar-light');
        
        break;

    case 'bg-danger':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-danger elevation-4');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-danger');

        break;

    case 'bg-primary':


        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-primary elevation-4');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-primary');

        break;  


    case 'bg-info':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-info elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-info');
            
        break;  


    case 'bg-lightblue':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-lightblue elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-lightblue');
            
        break;  

    
    case 'bg-navy':
        
        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-navy elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-navy');
            
        break;   
        
    case 'bg-purple':

                
        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-purple elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-purple');
    
        break;

    case 'bg-pink':

        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-pink elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-pink');
    
    
        break;

    case 'bg-fuchsia':

        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-fuchsia elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-fuchsia');
    
        break;

    case 'bg-success':


        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-success elevation-4');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-success');

    
        break;        

    case 'bg-teal':


        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-teal elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-teal');
    
        break;

    case 'bg-lime':


        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-lime elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-lime');
    
        break;

    case 'bg-olive':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-olive elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-olive');
    
    
        break;

    case 'bg-maroon':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-maroon elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-maroon');
    
        break;

    case 'bg-orange':


        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-orange elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-light  bg-orange');
    
        break;

    case 'bg-warning':    
        
        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-warning elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-light  bg-warning');

        break;

    default:

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4 ');
        Config::set('adminlte.classes_topnav', 'navbar-dark');

        break;


}


}

@endphp

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')

    <div class="wrapper">

        {{-- Preloader Animation (fullscreen mode) --}}
        @if($preloaderHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}

    <div id="panelNotificaciones" class=" container-fluid alert col-6 offset-2 mt-3 alert-secondary bg-gradient-light alert-dismissible fade show" role="alert" hidden>
        <p class="text-navy">Tiene notificaciones nuevas sin leer : <strong id="numNotificaciones" class="text-maroon"> 0</strong></p>
            <label>
                <input type="checkbox" id="desactivarNotificaciones">
                No mostrar más avisos de notificaciones durante esta sesión
            </label><br>
            <a id="irBandejaNotificaciones"  class="alert-link text-navy"><i class="fa fa-bell"></i> Ir a ver notificaciones</a>
            <a href="{{route('notificacion.marcar.leidas')}}" class="alert-link text-maroon p-3"><i class="fa fa-book"></i>Marcar como leidas</a>

        <button type="button" id="btnCloseOk" class="close"  aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
        <script>

    document.addEventListener("DOMContentLoaded", function () {
        let numNotificaciones = 0;
        let mostrarNotificaciones = sessionStorage.getItem('mostrarNotificaciones');
        let panelNotificaciones = document.getElementById('panelNotificaciones');
        hayNotificacionesNuevas();
        console.log(mostrarNotificaciones);
        
        document.addEventListener('click', function (e) {



            if (e.target.closest('#irBandejaNotificaciones')) {
                event.preventDefault(); 
                window.location.href = '/notificacion';
                if (panelNotificaciones) panelNotificaciones.hidden = true;
            }

            if(e.target.closest('#btnCloseOk')) {
                if (panelNotificaciones) panelNotificaciones.hidden = true;

                if(document.getElementById('desactivarNotificaciones').checked) {
                    sessionStorage.setItem('mostrarNotificaciones', false);
                }else{
                    sessionStorage.setItem('mostrarNotificaciones', true);
                }
            }
        });


           function hayNotificacionesNuevas() {
                let numNotificacionesHTML = document.getElementById('numNotificaciones');
                fetch(`/notificacion-nueva`)
              .then(res => res.json())
              .then(notificaciones => {
                
                 numNotificaciones = notificaciones.num_notificaciones;

                 if (mostrarNotificaciones === null || mostrarNotificaciones === "true") {
                    console.log(panelNotificaciones);
                    if(panelNotificaciones) {
                    panelNotificaciones.hidden = (numNotificaciones <= 0);
                    numNotificacionesHTML.innerHTML = numNotificaciones;
                    }
             
                }

              })
              .catch(error => console.log(error));
             }


             setInterval(() => {
                console.log(numNotificaciones);
                if(numNotificaciones>0 &&  mostrarNotificaciones === "true"){
                    hayNotificacionesNuevas();
                }
             }, 30000);


       

    })


 

</script>
@stop


