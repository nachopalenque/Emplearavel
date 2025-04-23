@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@php
//cargo el estilo del centro

use App\Models\Centro;


if (auth()->check()) {

$user = auth()->user();
$centro = Centro::find($user->id_centro);


switch ($centro->estilo){
    case 'light':

        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light');
        
        break;

    case 'bg-danger':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-danger elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-danger');

        break;

    case 'bg-primary':


        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-primary elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-primary');

        break;  


    case 'bg-info':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-info elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-info');
            
        break;  


    case 'bg-lightblue':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-lightblue elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-lightblue');
            
        break;  

    
    case 'bg-navy':
        
        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-navy elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-navy');
            
        break;   
        
    case 'bg-purple':

                
        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-purple elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-purple');
    
        break;

    case 'bg-pink':

        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-pink elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-pink');
    
    
        break;

    case 'bg-fuchsia':

        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-fuchsia elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-fuchsia');
    
        break;

    case 'bg-success':


        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-success elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-success');

    
        break;        

    case 'bg-teal':


        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-teal elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-teal');
    
        break;

    case 'bg-lime':


        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-lime elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light bg-lime');
    
        break;

    case 'bg-olive':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-olive elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-olive');
    
    
        break;

    case 'bg-maroon':

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary bg-maroon elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-dark bg-maroon');
    
        break;

    case 'bg-orange':


        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-orange elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light  bg-orange');
    
        break;

    case 'bg-warning':    
        
        Config::set('adminlte.classes_sidebar', 'sidebar-light-primary bg-warning elevation-4 sidebar-no-expand');
        Config::set('adminlte.classes_topnav', 'navbar-light  bg-warning');

        break;

    default:

        Config::set('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4 sidebar-no-expand');
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
@stop
