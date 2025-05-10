<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresión de fichajes</title>
</head>
<body>
<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Elija el intervalo de fechas que desea imprimir</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('fichaje.storePrint') }}" target="_blank">
              @csrf
              <div class="card-body">

                <div class="row">

                    <div class="col">

                        <x-adminlte-input type="date" name="fecha_inicio" label="Fecha de Inicio" label-class="text-lightblue" value="{{ old('fecha_inicio') }}">
                
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-calendar-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                
                        </x-adminlte-input>

                    </div>

                    <div class="col">
                      
                    
               
                        <x-adminlte-input type="date" name="fecha_fin" label="Fecha de Fin" label-class="text-lightblue" value="{{ old('fecha_fin') }}">
                
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-calendar-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                
                        </x-adminlte-input>
                    
                    </div>

              



                </div>
                <!-- /.card-body -->

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Imprimir fichajes"  theme="success" icon="fas fa-lg fa-print"/>

                </div>
              </form>
</div>
</body>
</html>