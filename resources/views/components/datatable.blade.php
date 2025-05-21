<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap4.min.css') }}">
  <title>Emple@Ravel</title>
</head>


<body>

@php

$rolAuth = auth()->user()->getRoleNames()->first();


@endphp
<div>

<section class="content">
      <div class="container-fluid">



        <!-- Modal Validaciones-->

       <div class="modal fade" id="modalValidaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-sm modal-md modal-lg modal-xl" role="document">
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <h5 class="modal-title" id="tituloModalValidaciones"></h5>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    
                    <div id="modalBodyValidaciones" class="modal-body">

                      @if($modeloNombre == 'Centro')

                      @include('Centro.create')
                      
                      @endif

                      @if($modeloNombre == 'Proyecto')

                      @include('Proyecto.create')
                      
                      @endif

                    </div>
                    
                    <div class="modal-footer">
                      <button type="button" id="btnCerrarModal" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
                    </div>
                  
                  </div>
                </div>
      </div>




    

       <!-- Modal Génerico-->

       <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-sm modal-md modal-lg modal-xl" role="document">
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <h5 class="modal-title" id="tituloModal"></h5>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    
                    <div id="modalBody" class="modal-body">

                    <!-- Código de llamada a la creación de un nuevo centro -->

                    </div>

                    <div id="modalBody2" class="card">


                    </div>
                    
                    <div class="modal-footer">
                      <button  type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
                    </div>
                  
                  </div>
                </div>
      </div>






    




      <div class="card">
              <div class="card-header">

                @if(count($items)>0)


                         @if($modeloNombre == 'Usuario')
                            <h3 class="card-title">Total registros encontrados: {{ count($items) }}</h3><br>

                         @else
                             <h3 class="card-title">Total registros encontrados: {{ $items->count() }}</h3><br>

                         @endif

                         @if($modeloNombre == 'Fichaje')

                            @if($items->isNotEmpty() && $items->first()?->estado == 'en curso')

                             <h4 class="display-6 text-info">Atención: Hay un fichaje en curso <i class="fas fa-hourglass-half text-lightblue"></i></h4> 


                            @endif

                          @endif

                @else

                      <h3 class="card-title">Aún no se han encontrado registros</h3><br>


                @endif
                
       


                <div class="card-tools">

                @if($modeloNombre == 'Proyecto')

                  @if($rolAuth == 'Administrador' || $rolAuth == 'ProductManager')
                    <button type="button" id="btnNuevoProyecto" class="btn btn-block btn-outline-success mb-3" data-toggle="modal" data-target="#modalValidaciones"><i class="fa fa-plus mr-1"></i>Nuevo {{$modeloNombre}}</button>

                  @endif

                @endif


                @if($modeloNombre == 'Fichaje')

                <button type="button" id="btnprintFichaje" class="btn btn-block btn-outline-info mb-3" data-toggle="modal" data-target="#modal"><i class="fa fa-print mr-1"></i>Imprimir fichajes</button>


                  @if($items->first()?->estado == 'en curso')

                  <button type="button"  class="btn btn-block btn-outline-success mb-3" onclick="window.location.href='/terminar-fichar'" ><i class="fa fa-plus mr-1"></i>Terminar {{$modeloNombre}}</button>


                  @else

                  <button type="button"  class="btn btn-block btn-outline-success mb-3 " onclick="window.location.href='/fichar'" ><i class="fa fa-plus mr-1"></i>Nuevo {{$modeloNombre}}</button>


                  @endif




                @elseif($modeloNombre == 'Centro')
                <button type="button" id='btnNuevo' class="btn btn-block btn-outline-success mb-3" data-toggle="modal" data-target="#modalValidaciones" ><i class="fa fa-plus mr-1"></i>Nuevo {{$modeloNombre}}</button>

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

                @if(count($items)>0)
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

                          @if($modeloNombre == 'Proyecto')
                            <th>Progreso</th>
                            <th>Porcentaje</th>

                          @endif

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

                        @if($modeloNombre == 'Proyecto')

                        <td>
                           
                            <div class="progress progress-xl flex-grow-1 w-100">
                                <div class="progress-bar progress-bar-danger" style="width: 20%"></div>
                              </div>

                        </td>

                        <td>

     
                               <span class="badge bg-danger ml-2">55%</span>

                 

                        </td>


                        @endif

                        @if($modeloNombre !== 'Fichaje')

                        <td class="text-left py-1 px-3 align-middle">
                          <div class="btn-group btn-group-sm">

                    
                    

                          @if($modeloNombre == 'Centro')

                  
                          <figure class=" btn-group btn-group-sm" title="Ver o editar centro productivo">
                            <button data-id="{{ $item->id }}"  class="btn btn-info mr-2 btn-editar-centro" data-toggle="modal" data-target="#modal">
                            <i class="fas fa-eye"></i>
                            </button>
                          </figure>


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
                          <button title="Eliminar centro productivo"  type="submit" value="" class="btn btn-danger btn-eliminar mr-2 ">
                          <i class="fas fa-trash"></i>
                          </button>
                          </form>



                          @endif

                          @if($modeloNombre == 'Empleado')


                          <figure class=" btn-group btn-group-sm">
                            <button data-id="{{ $item->id }}" title="Crear evento"  class="btn btn-info mr-2 btn-crear-evento" data-toggle="modal" data-target="#modal">
                            <i class="fas fa-clock"></i>
                            </button>
                          </figure>

                          @endif



                          @if($modeloNombre == 'Usuario')



                          <figure class=" btn-group btn-group-sm">
                            <button data-id="{{ $item->id }}" title="Cambiar centro productivo del usuario"  class="btn btn-info mr-2 btn-cambiar-centro" data-toggle="modal" data-target="#modal">
                            <i class="fas fa-city"></i>
                            </button>
                          </figure>

                          <figure class=" btn-group btn-group-sm">
                            <button data-id="{{ $item->id }}" title="Cambiar rol del usuario"  class="btn btn-warning mr-2 btn-cambiar-rol" data-toggle="modal" data-target="#modal">
                            <i class="fas fa-user-shield"></i>
                            </button>
                          </figure>



                          <form action="{{ route('usuario.destroy', ['usuario' => $item->id]) }}" method="POST" class="btn-group btn-group-sm">
                          @csrf
                          @method('DELETE')
                          <button  type="submit" title="Eliminar usuario" class="btn  btn-danger btn-eliminar mr-2 ">
                          <i class="fas fa-trash"></i>
                          </button>
                          </form>


                          @endif



                          @if($modeloNombre == 'Proyecto')

                                

                            

                                    <figure class=" btn-group btn-group-sm">
                                      <button data-id="{{ $item->id }}" id="btnProyectosDocs" title="Documentos del proyecto"  class="btn btn-warning mr-2 " data-toggle="modal" data-target="#modal">
                                      <i class="fas fa-file-alt"></i>
                                      </button>
                                    </figure>


                                  @if($rolAuth == 'Administrador' || $rolAuth == 'ProductManager') 

                                    <figure class=" btn-group btn-group-sm">
                                      <button data-id="{{ $item->id }}" id="btnProyectosMod" title="Modificar datos del proyecto"  class="btn btn-info mr-2" data-toggle="modal" data-target="#modal">
                                      <i class="fas fa-pen"></i>
                                      </button>
                                    </figure>

                                    <figure class=" btn-group btn-group-sm">
                                      <button data-id="{{ $item->id }}" id="btnProyectosEmp" title="Gestionar empleados del proyecto"  class="btn btn-success mr-2" data-toggle="modal" data-target="#modal">
                                      <i class="fas fa-users"></i>
                                      </button>
                                    </figure>

                                    <figure class=" btn-group btn-group-sm">
                                      <button data-id="{{ $item->id }}" title="Crear tareas"  class="btn btn-primary mr-2 btn-cambiar-centro" data-toggle="modal" data-target="#modal">
                                      <i class="fas fa-tasks"></i>
                                      </button>
                                    </figure>

                                    <form action="{{ route('proyecto.destroy', ['proyecto' => $item->id]) }}" method="POST" class="btn-group btn-group-sm">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" title="Eliminar proyecto" class="btn  btn-danger btn-eliminar mr-2 ">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    </form>


                                  @endif
                            


                          @endif


                        


                          </div>
                      </td>

                      @endif

                      </tr>
                      @endforeach
                  </tbody>
                </table>

                @endif
     
              </div>

              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $items->links() }}
                </ul>
              </div>
            </div>
     
     </div>
            <!-- /.card -->

         
      <!-- /.container-fluid -->
    </section>

</div>


@section('js')
  <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

  
  <script defer>

  /*
  Livewire puede eliminar internamente elementos del dom para volver a renderizarlos sin que el usuario lo aprecie. por este motivo
  no puedo capturar concretamente los eventos click de los elementos puesto que a veces ese elemento es null en el dom hasta que livewire
  lo vuelve a renderizar. Por eso escucho cualquier evento click y luego con closest y un selector ya sea de clase(.) o por id # puede darle la funcionalidad a ese botón, además closest me asegura que se ejecute la lógica aunque el click se haga sobre un hijo del padre, es decir que si tengo closest('button') y dentro tengo un icono y hago click en el icono, también se ejecuta la lógica
  */

  document.addEventListener('click', function (e) {





      /*
      Usamos el mismo modal pero escuchando el evento click del boton de impresión de fichajes.
      Donde hacemos un fetch para pedir la vista de impresión de fichajes por fechas

      */    
        if (e.target.closest('#btnprintFichaje')) {
          document.getElementById('modalBody').innerHTML = '';
          document.getElementById('tituloModal').innerHTML = 'Imprimir fichajes';
          fetch(`/fichaje-print`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }

         // Botón: Cambiar roles usuario
      if (e.target.closest('.btn-cambiar-rol')) {
          const btn = e.target.closest('.btn-cambiar-rol');
          const id = btn.dataset.id;
          document.getElementById('modalBody').innerHTML = '';
          document.getElementById('tituloModal').innerHTML = 'Cambiar rol del usuario';
          fetch(`/edit/rol/user/${id}`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }

               // Botón: Crear evento empleado
      if (e.target.closest('.btn-crear-evento')) {
          const btn = e.target.closest('.btn-crear-evento');
          const id = btn.dataset.id;
          console.log(id)
          document.getElementById('tituloModal').innerHTML = 'Crear evento empleado';
          fetch(`/evento/empleado/create/${id}`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }




      // Botón: Editar centro
      if (e.target.closest('.btn-editar-centro')) {
          const btn = e.target.closest('.btn-editar-centro');
          const id = btn.dataset.id;
          document.getElementById('tituloModal').innerHTML = 'Editar Centro Productivo';
          fetch(`/centro/${id}/edit`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }

      /* recorremos todos los botones con el selector de clases btn-cambiar-centro
          y escuchamos el evento click para luego guardar el id del atributo data-id donde se almacena el id del usuario
          por ultimo hacemos una petición fetch a la ruta /usuario/cambiarCentro/{id} pasandole el id del usuario
          en el controlador de usuarios al hacer get a esta ruta nos devuelve la vista para editar el centro del usuario
          por lo tanto tenemos que indicar que la respuesta nos devuelve un texto plano que en este caso es una vista html
          y despues esa vista html la insertamos dentro del body del modal

          
      */
      if (e.target.closest('.btn-cambiar-centro')) {
          const btn = e.target.closest('.btn-cambiar-centro');
          const id = btn.dataset.id;
          document.getElementById('modalBody').innerHTML = '';
          document.getElementById('tituloModal').innerHTML = 'Cambiar usuario de centro productivo';
          fetch(`/usuario/cambiarCentro/${id}`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
     
     
      }

            // Botón: Añadir documentos intranet
      if (e.target.closest('#btnProyectosDocs')) {
          const btn = e.target.closest('#btnProyectosDocs');
          const id = btn.dataset.id;
          document.getElementById('tituloModal').innerHTML = 'Documentos del proyecto';
          fetch(`/proyecto/intranet/docs/${id}`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }


      //Botón : Editar datos del proyecto
      if (e.target.closest('#btnProyectosMod')) {
          const btn = e.target.closest('#btnProyectosMod');
          const id = btn.dataset.id;
          document.getElementById('tituloModal').innerHTML = 'Editar Proyecto';
          fetch(`/proyecto/${id}/edit`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }

            //Botón : Editar datos del proyecto
      if (e.target.closest('#btnProyectosEmp')) {
          const btn = e.target.closest('#btnProyectosEmp');
          const id = btn.dataset.id;
          document.getElementById('modalBody').innerHTML = '';
          document.getElementById('tituloModal').innerHTML = 'Incluir o quitar empleados al proyecto';
          

        fetch(`/proyecto/empleados/${id}`)

            .then(res => res.text())
            .then(html => {
                document.getElementById('modalBody').innerHTML = html;
            })
            .catch(error => {
                console.error('Error al cargar empleados:', error);
            });
          
          
          
          fetch(`/proyecto/incluir/empleados/${id}`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = document.getElementById('modalBody').innerHTML + html;
              })
              .catch(error => {
                console.error('Error al cargar empleados:', error);
            });
          ;
      }





  });

    





</script>



@endsection




  
</body>




</html>