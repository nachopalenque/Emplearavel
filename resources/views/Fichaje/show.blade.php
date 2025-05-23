
 
   <div class="container-fluid">





            <div class="card">
              <div class="card-header">

          
                        <h3 class="card-title">Total de fichajes: {{ count($fichajes) }}</h3>
      
              </div>

              <div class="card-body">

              @if(count($fichajes)>0)

              <table class="table table-bordered">
                  <thead>

                      <tr>
                          <th hidden>id</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th>Estado</th>
                          <th>Tiempo Fichaje</th>
                    

      
                     
                     </tr>

                  </thead>
                  <tbody>
                        @foreach ($fichajes as $fichaje)

                
                      
                            <tr>

                                <td class="text-left py-1 px-3 align-middle" hidden>{{ $fichaje->id }}</td>
                                <td class="text-left py-1 px-3 align-middle" >{{ $fichaje->fecha_inicio }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $fichaje->fecha_fin }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $fichaje->estado }}</td>
                                <td class="text-left py-1 px-3 align-middle">{{ $fichaje->tiempo_fichaje }}</td>
                            



                            </tr>
                               
                        @endforeach
                  </tbody>

             

                </table>

                @else
                <p class="text-center text-info">Este empleado aún no tiene fichajes</p>
                @endif


              </div>
   

             <div>

                  <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $fichajes->links() }}
                </ul>
              </div>
            </div>


        </div>
     




