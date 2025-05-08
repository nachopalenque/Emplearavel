@extends('adminlte::page')

@section('title', 'Ficha Empleado')

@section('content_header')
    <h1>Ficha Empleado</h1>
@stop

@section('content')
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Datos del empleado</h3>
              </div>

              <form method="POST" action="{{ route('empleado.update', $empleado->id) }}">
              @csrf
              @method('PUT')
              <!-- /.card-header -->
              <div class="card-body">
                <form>

                  <input type="text" name="id" value="{{$empleado->id}}" hidden="true">
                  
                  <div class="row">


                    <div class="col-sm-6">

          
                    <x-adminlte-input type="text" name="nombre" label="Nombre"  label-class="text-lightblue" value="{{$empleado->nombre}}" >
                    
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>



                    <div class="col-sm-6">
                      <!-- text input -->
                      <x-adminlte-input type="text" name="apellidos" label="Apellidos"  label-class="text-lightblue" value="{{$empleado->apellidos}}" >
                    
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-id-badge text-lightblue"></i>
                              </div>
                          </x-slot>
                        
                      </x-adminlte-input>


                    </div>
         
                  </div>


          


                  <div class="row">

                     <div class="col-sm-6">
                        <!-- text input -->
                        <x-adminlte-input type="text" name="telefono" label="Teléfono"  label-class="text-lightblue" value="{{$empleado->telefono}}" >
                    
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-phone text-lightblue"></i>
                              </div>
                          </x-slot>
                  
                        </x-adminlte-input>
                    

                     </div>
                        

                      <div class="col-sm-6">
                      <!-- text input -->
                                                     
                        <x-adminlte-input type="text" name="provincia" label="Provincia"  label-class="text-lightblue" value="{{$empleado->provincia}}" >
            
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-map text-lightblue"></i>
                              </div>
                          </x-slot>

                        </x-adminlte-input>


                     </div>





                    </div>


                    <div class="row">


                        <div class="col-sm-6">
                        <!-- text input -->

                                       
                           <x-adminlte-input type="text" name="localidad" label="Localidad" label-class="text-lightblue" value="{{ $empleado->localidad }}" >
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-home text-lightblue"></i>
                                    </div>
                                </x-slot>
    
                            </x-adminlte-input>



                        </div>


                        <div class="col-sm-6">
                      
                                                           
                          <x-adminlte-input type="text" name="pais" label="País"  label-class="text-lightblue" value="{{ $empleado->pais }}" >
                              
                              <x-slot name="prependSlot">
                                  <div class="input-group-text">
                                      <i class="fas fa-flag text-lightblue"></i>
                                  </div>
                              </x-slot>

                          </x-adminlte-input>


                            
                        </div>





                    </div>







                    <div class="row">



                        <div class="col-sm-6">
                        <!-- text input -->
                                           
                            <x-adminlte-input type="text" name="codigo_postal" label="Código Postal"  label-class="text-lightblue" value="{{ $empleado->codigo_postal }}" >
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-compass text-lightblue"></i>
                                    </div>
                                </x-slot>
            
                            </x-adminlte-input>

                        </div>


                        <div class="col-sm-6">

                                                      
                            <x-adminlte-input type="text" name="puesto" label="Puesto de trabajo" label-class="text-lightblue" value="{{ $empleado->puesto }}" >
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-clipboard text-lightblue"></i>
                                    </div>
                                </x-slot>
            
                            </x-adminlte-input>





                        </div>

                     </div>





                    <div class="row">


                     

                        <div class="col-sm-6">
                        <!-- textarea -->

                        <x-adminlte-textarea name="direccion" label="Dirección" rows=3 label-class="text-lightblue"
                            igroup-size="sm"  >
                            {{ old('direccion', $empleado->direccion) }}
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-address-book text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>
                            
                        </div>


                    </div>


                    <div class="card-footer">
                    <x-adminlte-button class="btn-flat" type="submit" label="Guardar cambios" theme="success" icon="fas fa-lg fa-save"/>
                    <x-adminlte-button class="btn-flat" type="button" label="Volver a la lista" theme="info" icon="fas fa-lg fa-arrow-left"  onclick="window.location.href = '{{ route('empleado.showAuth') }}'"/>

                    </div>


                    
                </form>

    </div>


@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop