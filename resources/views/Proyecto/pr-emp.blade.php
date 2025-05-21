<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados del proyecto</title>
</head>
<body>
     
              @if(count($empleados)>0)

              <table class="table table-bordered">
                  <thead>

                      <tr>
                          <th>Nombre</th>
                          <th>Apellidos</th>
                          <th>Puesto de trabajo que desempeña</th>
                          <th>Acción</th>

                     </tr>

                  </thead>
                  <tbody>
                    
                        @foreach ($empleados as $empleado)

                      
                   
                            <tr>
                                <td class="text-left py-1 px-3 align-middle text-info">{{ $empleado->nombre }}</td>
                                <td class="text-left py-1 px-3 align-middle text-info">{{ $empleado->apellidos }}</td>
                                <td class="text-left py-1 px-3 align-middle text-info">{{ $empleado->puesto }}</td>

                                <td>
                                    <form action="{{ route('proyecto.empleados.destroy', ['id' => $empleado->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Quitar empleado del proyecto" class="text-danger m-1 border-0 bg-transparent">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    </form>

                                </td>
                            </tr>

                  
                        @endforeach
                  </tbody>

             

                </table>

                @else
                <p class="text-center text-info">Aún no hay ningún empleado trabajando en el proyecto</p>
                @endif
</body>
</html>