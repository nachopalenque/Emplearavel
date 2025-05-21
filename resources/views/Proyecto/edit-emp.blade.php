<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>actualizar proyecto</title>
</head>
<body>

              <form class="form" method="POST" action="{{ route('proyecto.update', $id) }}">
              @csrf
              @method('PUT')
                <!-- /.card-body -->

                    <div class="col">
                        <x-adminlte-select2  name="empleados[]" label="Empleados disponibles"
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

                    <x-adminlte-button class="btn-flat" type="submit" label="Añadir empleados al proyecto" theme="success" icon="fas fa-lg fa-save"/>


                    </div>
              </form>





</body>
</html>