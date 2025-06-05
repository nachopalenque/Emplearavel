<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>actualizar proyecto</title>
</head>
<body>
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Datos del proyecto seleccionado</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form" method="GET" action="{{ route('proyecto.edit', $proyecto->id) }}">
   
              <div class="card-body">

                <div class="row">

                    <div class="col">

                    <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="Ingrese el nombre del Proyecto"  label-class="text-lightblue" value="{{ old('nombre', $proyecto->nombre) }}" disabled>
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-briefcase text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>

                    <div class="col">
                      
                    
               
                    <x-adminlte-input type="date" name="fecha_fin" label="Fecha de finalización del proyecto estimada"  label-class="text-lightblue" value="{{ old('fecha_fin', Carbon\Carbon::parse($proyecto->fecha_fin)->format('Y-m-d')) }}" disabled>
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-lg fa-calendar-check text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>
                    
                    </div>

                </div>

            



                 <div class="row">
       

          
                    <div class="col">

                        <x-adminlte-textarea name="descripcion" label="Descripción" rows=3 label-class="text-lightblue"
                            igroup-size="sm" placeholder="Ingrese la descripción del proyecto" disabled>
                            {{ old('descripcion', $proyecto->descripcion) }}
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-align-left text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>

                    </div>

             


                </div>



                  <div class="row">
       

          
                    <div class="col">

                           <div class="form-group ">
                            <label class="text-lightblue">Estado del proyecto</label>
                         <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-hourglass-half	 text-lightblue"></i></span>
                            <select name="estado" class="form-control text-dark" id="estilo" disabled>
                                
                                {old('estado', $proyecto->estado)}

                                <option value="Pendiente" >Pendiente</option>     
                                <option value="En curso" >En curso</option>
                                <option value="En desarrollo" >En desarrollo</option>
                                <option value="En fase de pruebas" >En fase de pruebas </option>
                                <option value="Finalizado" >Finalizado</option>
                              
                            </select>
                         </div>

                        </div>

                    </div>

                    <div class="col">

                        <div class="form-group">
                             <x-adminlte-input name="progreso_proyecto" label="Progreso porcentual del proyecto" label-class="text-lightblue" placeholder="Porcentaje proyecto" type="number"
                                igroup-size="m" min=0 max=100 value="{{ old('progreso_proyecto', $proyecto->progreso_proyecto) }}" disabled>
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-lightblue">
                                        <i class="fas fa-percent"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>





                        </div>

                    </div>

             


                </div>





                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <x-adminlte-button class="btn-flat" type="submit" label="Editar Proyecto" theme="success" icon="fa-lg fas fa-pen"/>

                </div>
              </form>
</div>





</body>
</html>