<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap4.min.css') }}">

    <title>crear proyecto</title>
</head>
<body>
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Rellene los datos para crear un nuevo proyecto</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form" method="POST" action="{{ route('proyecto.store') }}">
              @csrf
              <div class="card-body">

                <div class="row">

                    <div class="col">

                    <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="Ingrese el nombre del Proyecto"  label-class="text-lightblue" value="{{ old('nombre') }}" >
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-briefcase text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>

                    <div class="col">
                      
                    
               
                    <x-adminlte-input type="date" name="fecha_fin" label="Fecha de finalización del proyecto estimada"  label-class="text-lightblue" value="{{ old('fecha_fin') }}">
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-lg fa-calendar-check text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>
                    
                    </div>

                </div>

            


                <div class="row">
            
                    @php

                            use App\Models\Empleado;

                            $empleados = Empleado::all();

                    @endphp


                    <div class="col">
                        <x-adminlte-select2  name="empleados[]" label="Empleados"
                        label-class="text-lightblue" 
                        igroup-size="sm"
                        :config="['multiple' => true, 
                        'theme' => 'bootstrap4',
                        'tags' => 'true',
                        'allowClear' => true,
                        ]" id="empleados">
                        
                        {{-- Placeholder visible sólo si no hay elementos seleccionados --}}
                        <option disabled >Escriba para buscar un empleado...</option>

                        @foreach ($empleados as $empleado)
                            <option  value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                        @endforeach

                  
                    </x-adminlte-select2>

                    </div>

                </div>


                 <div class="row">
       

          
                    <div class="col">

                        <x-adminlte-textarea name="descripcion" label="Descripción" rows=3 label-class="text-lightblue"
                            igroup-size="sm" placeholder="Ingrese la descripción del proyecto" text="{{ old('descripcion') }}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-align-left text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>

                    </div>

             


                </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar Proyecto" theme="success" icon="fas fa-lg fa-save"/>
                <x-adminlte-button class="btn-flat" type="reset" label="Limpiar formulario" theme="danger" icon="fas fa-lg fa-trash"/>

                </div>
              </form>
</div>


<!-- Incluir el JS de Select2 -->

<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>


</body>
</html>