@extends('adminlte::page')

@section('title', 'Listado de Tareas')

@section('content_header')
    <h1>Mis tareas</h1>
    <hr>
@stop

@section('content')
 
@php

$filtroNombreTarea = session()->get('tareas_nombre');

@endphp
   <div class="container-fluid">


              <!-- Modal Génerico-->

                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered  modal-sm modal-md modal-lg modal-xl" role="document">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                <h5 class="modal-title" id="tituloModal"></h5>
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                
                                <div id="modalBody" class="modal-body">

                                <!-- Código de llamada a la creación de un nuevo centro -->

                                </div>

                                <div id="modalBody2" class="card">


                                </div>
                                
                                <div class="modal-footer">
                                <button  type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
                                </div>
                            
                            </div>
                            </div>
                </div>




            <div class="card">
              <div class="card-header">

          
                        <h3 class="card-title">Total de tareas: {{ count($tareas) }}</h3>
      


                            <div class="card-tools">
                                 <div class="card card-info card-outline p-3">



                                    @if($filtroNombreTarea != null)

                                  

                                            <button type="button" id="btnQuitarFiltrarTarea" class="btn-sm btn-block btn-outline-info mb-3" onclick="window.location.href='/tareas'">
                                                <i class="fas fa-times"></i>Quitar filtro
                                            </button>



                                    @else

                            
                                            @if(count($tareas)>0)

                                                <button type="button"  id="btnFiltrar" class="btn-sm btn-block btn-outline-info mb-3" data-toggle="modal" data-target="#modal">
                                                    <i class="fas fa-search"></i>Filtrar por nombre de tarea
                                                </button>
                                            @else

                                                <label for="" class="text-maroon">Aún no hay funcionalidades disponibles</label>


                                            @endif
                                           

                                    @endif

                                    <!-- Si no hay tareas no aparecen los filtros -->
                                    @if(count($tareas)>0)


                                        <div class="input-group input-group-sm">
                                            <label class="text-lightblue m-1">Filtrar por:</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-history text-lightblue"></i></span>

                                                <select name="estado" id="selectEstado">
                                                    <option value="Pendiente" {{ $estadoSeleccionado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="En curso" {{ $estadoSeleccionado == 'En curso' ? 'selected' : '' }}>En curso</option>
                                                    <option value="Parada" {{ $estadoSeleccionado == 'Parada' ? 'selected' : '' }}>Parada</option>
                                                    <option value="Cancelada" {{ $estadoSeleccionado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                                    <option value="Terminada" {{ $estadoSeleccionado == 'Terminada' ? 'selected' : '' }}>Terminada</option>
                                                    <option value="Todas" {{ $estadoSeleccionado == 'Todas' ? 'selected' : '' }}>Todas</option>
                                                </select>
                                            </div>
                                        </div>



                                    @endif
                
                                 </div>
                            </div>

             


              </div>

              <div class="card-body">

              @if(count($tareas)>0)
             <div class="table-responsive">

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
                                    @php
                                    $color = '';
                                    $style = '';
                                    switch ($tarea->estado_evento) {
                                        case 'Pendiente':
                                            $color = 'text-warning';
                                            $style = 'font-weight: bold';
                                            break;
                                        case 'En curso':
                                            $color = 'text-info';
                                            $style = 'font-weight: bold';
                                            break;
                                        case 'Parada':

                                            $color = 'text-danger';
                                            $style = 'font-weight: bold';
                                            break;

                                        case 'Cancelada':
                                            $color = 'text-maroon';
                                            $style = 'font-weight: bold';
                                            break;
                                        case 'Terminada':
                                            $color = 'text-success';
                                            $style = 'text-decoration: line-through;
                                            font-weight: bold;';
                                            break;

                                        default:
                                            $color = '';
                                            $style = '';
                                            break;
                                    }
                                    @endphp

                                <td class="text-left py-1 px-3 align-middle" hidden>{{ $tarea->id }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->nombre }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->titulo }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->observaciones }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->fecha_inicio }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->fecha_fin }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->estado_evento }}</td>
                                <td class="text-left py-1 px-3 align-middle">
                                
                                <figure class=" btn-group btn-group-sm">
                                    <button data-id="{{ $tarea->id }}" id="btnCambiarEstado" title="Cambiar estado de la tareas"  class="btn btn-secondary m-2" data-toggle="modal" data-target="#modal">
                                     <i class="fas fa-stopwatch"></i>
                                     </button>
                                </figure>

                                </td>


                            </tr>
                               
                        @endforeach
                  </tbody>

             

                </table>
                </diV>

                @else
                <p class="text-center text-info">Aún no tiene asignada ninguna tarea</p>
                @endif


              </div>
   

             <div>

                  <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $tareas->links() }}
                </ul>
              </div>
            </div>


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

<script>


       window.addEventListener('DOMContentLoaded', (event) => {

    
            switch(@json(session('estado'))){

            case 'creado':
            mensajeConfirmacionNuevoElemento();
            break;

            case 'actualizado':
            mensajeConfirmacionActualizacionElemento();
            break;
            
            case 'eliminado':
            mensajeConfirmacionEliminacionElemento();
            break;
            }

                document.addEventListener('click', function (e) {


                        //Botón : Para abrir el modal que cambia el estado de la tarea
                    if (e.target.closest('#btnCambiarEstado')) {
                        const btn = e.target.closest('#btnCambiarEstado');
                        const id = btn.dataset.id;
                        document.getElementById('tituloModal').innerHTML = 'Cambiar estado de la tarea';
                        fetch(`/tareas/${id}/edit`)
                            .then(res => res.text())
                            .then(html => {
                                document.getElementById('modalBody').innerHTML = html;
                            });
                    }


                    if (e.target.closest('#btnFiltrar')) {
                        console.log('boton filtrar');
                        fetch(`/tareas/nombre/filtrar`)
                            .then(res => res.text())
                            .then(html => {
                                document.getElementById('modalBody').innerHTML = html;
                            })
                            .catch(error => {
                            console.error('Error al cargar empleados:', error);
                        });
    
                    }
                    

                });


               const select = document.getElementById('selectEstado');

                    select.addEventListener('change', (event) => {
                            const estado = select.value;
                            console.log(estado);
                            window.location.href = `/tareas/estado/${estado}`
                                        
                    });


        

        });


  




        
      </script>


@endpush