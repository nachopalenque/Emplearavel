
 
   <div class="container-fluid">





            <div class="card">
              <div class="card-header">

          
                        <h3 class="card-title">Total de tareas: {{ count($tareas) }}</h3>
      
              </div>

              <div class="card-body">

              @if(count($tareas)>0)

              <table class="table table-bordered">
                  <thead>

                      <tr>
                          <th hidden>id</th>
                          <th>Proyecto</th>
                          <th>Tarea</th>
                          <th>Descripción de la tarea</th>
                          <th>Fecha de Inicio</th>
                          <th>Fecha de Fin</th>
                          <th>Estado</th>   

      
                     
                     </tr>

                  </thead>
                  <tbody>
                        @foreach ($tareas as $tarea)

                
                      
                            <tr>
                                    @php
                                    $color = '';
                                    $style = '';
                                    switch ($tarea->estado_evento) {
                                        case 'Pendiente':
                                            $color = 'text-warning';
                                            $style = 'font-weight: bold';
                                            break;
                                        case 'En curso':
                                            $color = 'text-info';
                                            $style = 'font-weight: bold';
                                            break;
                                        case 'Parada':

                                            $color = 'text-danger';
                                            $style = 'font-weight: bold';
                                            break;

                                        case 'Cancelada':
                                            $color = 'text-maroon';
                                            $style = 'font-weight: bold';
                                            break;
                                        case 'Terminada':
                                            $color = 'text-success';
                                            $style = 'text-decoration: line-through;
                                            font-weight: bold;';
                                            break;

                                        default:
                                            $color = '';
                                            $style = '';
                                            break;
                                    }
                                    @endphp

                                <td class="text-left py-1 px-3 align-middle" hidden>{{ $tarea->id }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->nombre }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->titulo }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->observaciones }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->fecha_inicio }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->fecha_fin }}</td>
                                <td class="text-left py-1 px-3 align-middle {{ $color }}" style="{{ $style }}">{{ $tarea->estado_evento }}</td>



                            </tr>
                               
                        @endforeach
                  </tbody>

             

                </table>

                @else
                <p class="text-center text-info">Aún no tiene asignada ninguna tarea</p>
                @endif


              </div>
   

             <div>

                  <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $tareas->links() }}
                </ul>
              </div>
            </div>


        </div>
     




