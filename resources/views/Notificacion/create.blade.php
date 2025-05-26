<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Notificación</title>
</head>
@php
use App\Models\Empleado;
$empleados = Empleado::all();

@endphp
<body>
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Rellene los datos para crear una nueva notificación</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form" method="POST" action="{{ route('notificacion.store') }}">
              @csrf
              <div class="card-body">


                <div class="row">

                    <div class="col">
                        <label for="empleado" class="text-lightblue">Buscar empleado</label>
                        <input list="empleados" name="empleado" class="form-control" />

                        <datalist id="empleados">
                            @foreach($empleados as $empleado)
                          <option value="{{ $empleado->nombre }} {{ $empleado->apellidos }}">

                            @endforeach
                        </datalist>
                    </div>

                  

                </div>

                <div class="row">

                    <div class="col">

                    <x-adminlte-input type="text" name="titulo" label="Asunto" placeholder="Ingrese el asunto de la notificación"  label-class="text-lightblue" value="{{ old('titulo') }}" >
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>

                  

                </div>

                <div class="row">

                    <div class="col">


                        <x-adminlte-textarea name="texto" label="Texto" rows=3 label-class="text-lightblue"
                            igroup-size="sm" placeholder="Ingrese el contenido del mensaje" text="{{ old('texto') }}">
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
                <x-adminlte-button class="btn-flat" type="submit" label="Mandar notificación" theme="success" icon="fas fa-lg fa-save"/>
                <x-adminlte-button class="btn-flat" type="reset" label="Limpiar formulario" theme="danger" icon="fas fa-lg fa-trash"/>

                </div>
              </form>
</div>
</body>
</html>