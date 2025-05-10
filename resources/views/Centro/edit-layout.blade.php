
@extends('adminlte::page')

@section('title', 'Centro Productivo')

@section('content_header')
    <h1>Editar Centro Productivo</h1>
@stop

@section('content')
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Actualice los datos del Centro Productivo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('centro.update', $centro->id) }}">
              @csrf
              @method('PUT')

              <div class="card-body">

                <div class="row">

                    <div class="col">

                    <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="Ingrese el nombre del Centro Productivo"  label-class="text-lightblue" value="{{$centro->nombre}}" >
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>

                    <div class="col">
                      
                    
               
                    <x-adminlte-input type="text" name="razon_social" label="Razón Social" placeholder="Ingrese la Razón Social de su empresa u organización" label-class="text-lightblue" value="{{$centro->razon_social}}">
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>
                    
                    </div>

                </div>

                <div class="row">

                    <div class="col">


                                    
                    <x-adminlte-input type="text" name="CIF" label="CIF" placeholder="Ingrese el CIF de su empresa u organización " label-class="text-lightblue" value="{{$centro->CIF}}">
            
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-address-card text-lightblue"></i>
                            </div>
                        </x-slot>
            
                    </x-adminlte-input>

                    </div>

                    <div class="col">


                              
                    <x-adminlte-input type="text" name="provincia" label="Provincia" placeholder="Ingrese la Provincia del Centro Productivo" label-class="text-lightblue" value="{{$centro->provincia}}">
            
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map text-lightblue"></i>
                            </div>
                        </x-slot>
            
                    </x-adminlte-input>

                    
                    </div>

                </div>

                <div class="row">

                    <div class="col">


                                       
                        <x-adminlte-input type="text" name="localidad" label="Localidad" placeholder="Ingrese la localidad del Centro Productivo" label-class="text-lightblue" value="{{ $centro->localidad }}">
                
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-home text-lightblue"></i>
                                </div>
                            </x-slot>
                
                        </x-adminlte-input>



                       
                     </div>

          
                    <div class="col">



                     
                                       
                            <x-adminlte-input type="text" name="codigo_postal" label="Código Postal" placeholder="Ingrese el código postal del Centro Productivo" label-class="text-lightblue" value="{{ $centro->codigo_postal }}">
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-compass text-lightblue"></i>
                                    </div>
                                </x-slot>
            
                            </x-adminlte-input>


                    </div>

                </div>



                <div class="row">
            
                    <div class="col">


                                       
                        <x-adminlte-input type="text" name="pais" label="País" placeholder="Ingrese el país del Centro Productivo" label-class="text-lightblue" value="{{ $centro->pais }}">
                    
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-flag text-lightblue"></i>
                                </div>
                            </x-slot>
        
                        </x-adminlte-input>


                   

                    </div>

          
                    <div class="col">

            



                        <div class="form-group ">
                            <label class="text-lightblue">Estilo Corporativo</label>
                         <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-palette text-lightblue"></i></span>
                            <select name="estilo" class="form-control text-dark" id="estilo">
                                @php $estiloSeleccionado = old('estilo', $centro->estilo ?? 'none'); @endphp

                                <option value="none" {{ $estiloSeleccionado == 'none' ? 'selected' : '' }}>Por defecto</option>
                                <option value="light" style="background-color: white; color: black" {{ $estiloSeleccionado == 'light' ? 'selected' : '' }}>Blanco</option>
                                <option value="bg-danger" style="background-color: red; color: white" {{ $estiloSeleccionado == 'bg-danger' ? 'selected' : '' }}>Rojo</option>
                                <option value="bg-primary" style="background-color: #006db7; color: white" {{ $estiloSeleccionado == 'bg-primary' ? 'selected' : '' }}>Azul</option>
                                <option value="bg-info" style="background-color: #0099e7; color: white" {{ $estiloSeleccionado == 'bg-info' ? 'selected' : '' }}>Azul claro</option>
                                <option value="bg-lightblue" style="background-color: rgba(0, 194, 251, 0.78); color: white" {{ $estiloSeleccionado == 'bg-lightblue' ? 'selected' : '' }}>Azul claro celeste</option>
                                <option value="bg-navy" style="background-color: rgba(13, 29, 154, 0.78); color: white" {{ $estiloSeleccionado == 'bg-navy' ? 'selected' : '' }}>Azul Oscuro</option>
                                <option value="bg-purple" style="background-color: rgba(73, 34, 148, 0.78); color: white" {{ $estiloSeleccionado == 'bg-purple' ? 'selected' : '' }}>Morado</option>
                                <option value="bg-pink" style="background-color: rgba(252, 110, 212, 0.78); color: white" {{ $estiloSeleccionado == 'bg-pink' ? 'selected' : '' }}>Rosa</option>
                                <option value="bg-fuchsia" style="background-color: rgba(232, 35, 189, 0.78); color: white" {{ $estiloSeleccionado == 'bg-fuchsia' ? 'selected' : '' }}>Fucsia</option>
                                <option value="bg-success" style="background-color: rgba(0, 205, 43, 0.78); color: white" {{ $estiloSeleccionado == 'bg-success' ? 'selected' : '' }}>Verde</option>
                                <option value="bg-teal" style="background-color: rgba(0, 216, 159, 0.78); color: white" {{ $estiloSeleccionado == 'bg-teal' ? 'selected' : '' }}>Verde Turquesa</option>
                                <option value="bg-lime" style="background-color: rgba(0, 255, 69, 0.78); color: white" {{ $estiloSeleccionado == 'bg-lime' ? 'selected' : '' }}>Verde Lima</option>
                                <option value="bg-olive" style="background-color: rgba(50, 174, 75, 0.78); color: white" {{ $estiloSeleccionado == 'bg-olive' ? 'selected' : '' }}>Verde Olivo</option>
                                <option value="bg-maroon" style="background-color: maroon; color: white" {{ $estiloSeleccionado == 'bg-maroon' ? 'selected' : '' }}>Maroon</option>
                                <option value="bg-orange" style="background-color: orange; color: white" {{ $estiloSeleccionado == 'bg-orange' ? 'selected' : '' }}>Naranja</option>
                                <option value="bg-warning" style="background-color: #e0b700; color: white" {{ $estiloSeleccionado == 'bg-warning' ? 'selected' : '' }}>Amarillo</option>
                            </select>
                         </div>

                        </div>
                    </div>

                </div>


                 <div class="row">
       

          
                    <div class="col">

                        <x-adminlte-textarea name="direccion" label="Dirección" rows=3 label-class="text-lightblue"
                            igroup-size="sm" placeholder="Ingrese la Dirección del Centro Productivo">
                            {{ old('direccion', $centro->direccion) }}
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-address-book text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>

                    </div>


                </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar cambios" theme="success" icon="fas fa-lg fa-save"/>
                <x-adminlte-button class="btn-flat" type="button" label="Volver a la lista" theme="info" icon="fas fa-lg fa-arrow-left"  onclick="window.location.href = '{{ route('centro.index') }}'"/>

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