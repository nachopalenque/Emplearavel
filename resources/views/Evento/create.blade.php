<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo evento</title>
</head>
<body>
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Rellene los datos para crear un evento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('evento.store') }}">
              @csrf
              <div class="card-body">

                <div class="row">

                    <div class="col">

                    <x-adminlte-input type="text" name="titulo" label="Titulo" placeholder="Ingrese el titulo del evento"  label-class="text-lightblue" value="{{ old('nombre') }}" >
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-heading text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>

                        <div class="col">
                      
                            <div class="form-group ">
                            <label class="text-lightblue">Tipo de Evento</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag text-lightblue"></i></span>
                                <select name="tipo_evento"  class="form-control text-dark" id="estilo">
                                <option value="none">Por defecto</option>
                                <option value="vacaciones">Día de vacaciones</option>
                                <option value="asuntos_propios">Día de asuntos propios</option>
                                <option value="baja" >Día de baja por enfermedad</option>
                                <option value="asistencia_medica">Asistencia a consulta médica</option>
                                <option value="otro" >Otros</option>
                
                                </select>
                            </div>

                            </div>
                        </div>

                </div>

        




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


                 <div class="row">
       

          
                    <div class="col">

                        <x-adminlte-textarea name="observaciones" label="Observaciones" rows=3 label-class="text-lightblue"
                            igroup-size="sm" placeholder="Aquí puede ingresar si lo desea información adicional" text="{{ old('observaciones') }}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-pencil-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>

                    </div>


                </div>

                <div class="row">
       

                    
                    <div class="col">


                        <x-adminlte-input type="file" name="adjunto" label="Adjuntar archivo" label-class="text-lightblue" value="{{ old('adjunto') }}">
                        
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-file text-lightblue"></i>
                                </div>
                            </x-slot>
                        
                         </x-adminlte-input>


                    </div>


                 </div>




                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar Evento" theme="success" icon="fas fa-lg fa-save"/>

                </div>
              </form>
</div>
</body>
</html>