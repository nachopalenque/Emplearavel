<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>centro</title>
</head>
<body>
<div>

<section class="content">
      <div class="container-fluid">


     <!-- Modal Nuevo -->

      <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-sm modal-md modal-lg modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Nuevo {{$modeloNombre}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                    <!-- Código de llamada a la creación de un nuevo centro -->

                    @if($modeloNombre == 'Centro')

                    @include('Centro.create')

                    @endif

                 

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
                    </div>
                  </div>
                </div>
      </div>



    




      <div class="card">
              <div class="card-header">
                @if($modeloNombre == 'Usuario')
                <h3 class="card-title">Total registros encontrados: {{ count($items) }}</h3><br>

                @else
                <h3 class="card-title">Total registros encontrados: {{ $items->count() }}</h3><br>

                @endif

                @if($modeloNombre == 'Fichaje')

                  @if($items->first()?->estado == 'en curso')

                  <h4 class="display-6 text-info">Atención: Hay un fichaje en curso!!</h4>


                  @endif

                @endif


                <div class="card-tools">

                @if($modeloNombre == 'Fichaje')

                  @if($items->first()?->estado == 'en curso')

                  <button type="button" class="btn btn-block btn-outline-success mb-3" wire:click="terminarFichaje({{$items->first()?->id}})" ><i class="fa fa-plus mr-1"></i>Terminar {{$modeloNombre}}</button>


                  @else

                  <button type="button" class="btn btn-block btn-outline-success mb-3" wire:click="fichar" ><i class="fa fa-plus mr-1"></i>Nuevo {{$modeloNombre}}</button>


                  @endif




                @elseif($modeloNombre !== 'Usuario')
                <button type="button" class="btn btn-block btn-outline-success mb-3" data-toggle="modal" data-target="#modalNuevo" ><i class="fa fa-plus mr-1"></i>Nuevo {{$modeloNombre}}</button>

                @endif



                  <div class="input-group input-group-sm" style="width: 150px;">

                    <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                    <div class="input-group-append">
                      
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                  </div>
                  
                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>

                      <tr>
                        @foreach($columNames as $columna)

                          @if($columna == 'id' ||  $columna == 'id_usuario' || $columna == 'password' || $columna == 'id_centro')
                            <th hidden>{{ $columna }}</th>
                          @else
                            <th>{{ $columna }}</th>
                          @endif

                         @endforeach

                         @if($modeloNombre !== 'Fichaje')
                         <th>Acciones</th>
                         @endif
                     </tr>

                  </thead>
                  <tbody>
                
                      @foreach($items as $item)

            
                      <tr id="{{ $item->id }}">
                        @foreach($columnas as $columna)

                          @if($columna == 'id' || $columna == 'id_usuario' || $columna == 'password' || $columna == 'id_centro')
                          <td hidden>{{ $item->$columna }}</td>
                          @else


                            <!-- Si es modelo fichaje y el estado es en curso se pondra el texto de color azul -->
                            @if($modeloNombre == 'Fichaje')

                           
                                @if($item ?->estado == 'en curso')

                                <td class="text-info">{{ $item->$columna }}</td>


                              <!-- Si es modelo fichaje y el estado no es en curso se pondra el texto de color verde -->

                                @else

                                <td class="text-success">{{ $item->$columna }}</td>


                                @endif

                            
                            @else

                              <td>{{ $item->$columna }}</td>


                            @endif


                          @endif

                        @endforeach

                        @if($modeloNombre !== 'Fichaje')

                        <td class="text-left py-1 px-3 align-middle">
                          <div class="btn-group btn-group-sm">

                    
                    

                          @if($modeloNombre == 'Centro')

                          <form action="{{ route('centro.edit', ['centro' => $item->id]) }}" method="GET" class="btn-group btn-group-sm">
                            <button  type="submit" value="" class="btn btn-info mr-2">
                            <i class="fas fa-eye"></i>
                            </button>
                          </form>

                          <!-- Boton usuarios 
                          <form action="{{ route('centro.edit', ['centro' => $item->id]) }}" method="POST" class="btn-group btn-group-sm">
                            <button  type="submit" value="" class="btn btn-secondary bg-pink mr-2">
                            <i class="fas fa-user"></i>
                            </button>
                          </form> 
                          -->

                        
                          <form action="{{ route('centro.destroy', ['centro' => $item->id]) }}" method="POST" class="btn-group btn-group-sm">
                          @csrf
                          @method('DELETE')
                          <button  type="submit" value="" class="btn  btn-danger mr-2 ">
                          <i class="fas fa-trash"></i>
                          </button>
                          </form>



                          @endif



                          @if($modeloNombre == 'Usuario')



                          <form action="{{ route('usuario.edit', ['usuario' => $item->id]) }}" method="GET" class="btn-group btn-group-sm">
                            <button  type="submit" value="" class="btn btn-info mr-2">
                            <i class="fas fa-eye"></i>
                            </button>
                          </form>


                          <form action="{{ route('usuario.destroy', ['usuario' => $item->id]) }}" method="POST" class="btn-group btn-group-sm">
                          @csrf
                          @method('DELETE')
                          <button  type="submit" value="" class="btn  btn-danger mr-2 ">
                          <i class="fas fa-trash"></i>
                          </button>
                          </form>


                          @endif


                        


                          </div>
                      </td>

                      @endif

                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>

              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
     
     </div>
            <!-- /.card -->

         
      <!-- /.container-fluid -->
    </section>

</div>

  
</body>



</html>