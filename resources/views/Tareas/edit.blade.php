<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar estado de la tarea</title>
</head>
<body>
<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Elija el estado actual de la tarea</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('tareas.update', $id_evento) }}">
              @csrf
              @method('PUT')
              <input type="text" name="id_evento" value="{{$id_evento}}" hidden="true">
              <div class="card-body">

                <div class="row">

                    <div class="col">
                    <div class="form-group ">
                            <label class="text-lightblue">Estados de la tarea</label>
                         <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-circle text-lightblue"></i></span>
                                <select name="estado_evento" class="form-control text-dark" id="estado">
                                <option value="Pendiente">Pendiente</option>
                                <option value="En curso">En curso</option>
                                <option value="Parada">Parada</option>
                                <option value="Cancelada">Cancelada</option>
                                <option value="Terminada">Terminada</option>                          
                            </select>
                         </div>

                        </div>
                    </div>

                  

              



                </div>
                <!-- /.card-body -->

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Cambiar de estado" theme="success" icon="fas fa-lg fa-sync-alt"/>

                </div>
              </form>
</div>
</body>
</html>