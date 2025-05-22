@extends('adminlte::page')

@section('title', 'Listado de Tareas')

@section('content_header')
    <h1>Listado de tareas</h1>
    <hr>
@stop

@section('content')
 
   <div class="container-fluid">

            <div class="card">
              <div class="card-header">

          
                        <h3 class="card-title">Total de tareas: {{ count($tareas) }}</h3>
      
              </div>

              <div class="card-body">

              @if(count($tareas)>0)

              <table class="table table-bordered">
                  <thead>

                      <tr>
                          <th hidden>id</th>
                          <th>Proyecto</th>
                          <th>Tarea</th>
                          <th>Descripción de la tarea</th>
                          <th>Fecha de Inicio</th>
                          <th>Fecha de Fin</th>
                          <th>Estado</th>   
                          <th>Acciones</th>

      
                     
                     </tr>

                  </thead>
                  <tbody>
                        @foreach ($tareas as $tarea)

                      
                            <tr>
                                <td class="text-left py-1 px-3 align-middle" hidden>{{ $tarea->id }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $tarea->nombre }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $tarea->titulo }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $tarea->observaciones }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $tarea->fecha_inicio }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $tarea->fecha_fin }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $tarea->estado_evento }}</td>

                               
                        @endforeach
                  </tbody>

             

                </table>

                @else
                <p class="text-center text-info">Aún no tiene asignada ninguna tarea</p>
                @endif


              </div>
   

             <div>

        


        </div>
     





@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@push('js')
<!--   aquí lo que hago es que me muestre el modal de nuevo si hay errores de validación -->
@if ($errors->any())

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modalElement = document.getElementById('modalNuevo');
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        });
    </script>
    
@endif

@if (session('estado') == 'eliminado')

    <script>

       window.addEventListener('DOMContentLoaded', (event) => {
            mensajeConfirmacionEliminado();
        });
        
      </script>
@endif


@if (session('etado') == 'creado')

    <script>
      
       window.addEventListener('DOMContentLoaded', (event) => {
        mensajeConfirmacionNuevoElemento();
        });
        
      </script>
@endif

@if (session('estado') == 'actualizado')

    <script>
      
       window.addEventListener('DOMContentLoaded', (event) => {
        mensajeConfirmacionActualizacionElemento();
        });
        
      </script>
@endif


@endpush