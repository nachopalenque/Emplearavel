<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>actualizar proyecto</title>
</head>
<body>


    <hr>
    <h4>Empleados disponibles para añadir al proyecto: </h4>

  @if(count($empleados)>0)

    <div class="card-body table-responsive p-0" style="height: 300px;">

              <table class="table table-bordered table-head-fixed text-nowrap">
                  <thead>

                      <tr>
                          <th>Empleado</th>
                          <th>Puesto de trabajo que desempeña</th>
                          <th>Acción</th>

                     </tr>

                  </thead>
                  <tbody>
                    
                        @foreach ($empleados as $empleado)

                      
                   
                            <tr>
                                <td class="text-left align-middle text-info">{{ $empleado->nombre . ' ' . $empleado->apellidos }}</td>
                                <td class="text-left align-middle text-info">{{ $empleado->puesto }}</td>

                                <td>
                                    <form action="{{ route('proyecto.empleados.store', ['id_proyecto'=> $id ,'id_empleado' => $empleado->id]) }}" method="POST" class="btn-group btn-group-sm">
                                    @csrf
                                    <button  type="submit" title="Añadir empleado al proyecto" class="btn  btn-success btn-eliminar mr-2 ">
                                    <i class="fas fa-plus"></i>
                                    </button>
                                    </form>

                                </td>
                            </tr>

                  
                        @endforeach
                  </tbody>

             

                </table>

    </div>

                @else
                <p class="text-center text-info">No hay más empleados disponibles</p>
                @endif


       




</body>
</html>