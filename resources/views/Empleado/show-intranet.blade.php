<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="content  overflow-auto">

        <div class="container-fluid">

            <div class="card">
              <div class="card-header">

          
                        <h3 class="card-title">Listado de archivos:</h3>
      
              </div>

              <div class="card-body">

              @if(count($documentos)>0)

              <table class="table table-bordered">
                  <thead>

                      <tr>
                          <th>Archivo</th>
                          <th>Acciones</th>
                     
                     </tr>

                  </thead>
                  <tbody>
                        @foreach ($documentos as $doc)

                         @php 
                                $nombreArchivo = collect(explode('/', $doc->adjunto))->last();
                        @endphp
                            <tr>
                                <td class="text-left py-1 px-3 align-middle text-info">{{ $nombreArchivo }}</td>
                                <td>
                                   


                                    <form action="{{ route('evento.destroy', ['evento' => $doc->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('ver.archivo.empleado', ['id' => $doc->id]) }}" class="text-info m-1" target="_blank" title="Ver documento"><i class="fas fa-eye"></i></a>
                             
                               
                                    <a href="{{ route('descarga.archivo.empleado', ['id' => $doc->id]) }}" class="text-warning m-1" title="Descargar documento" download><i class="fas fa-download"></i></a>
                                    
                                    <button  type="submit" title="Eliminar archivo"   class="text-danger m-1 border-0 bg-transparent">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                  </tbody>

             

                </table>

                @else
                <p class="text-center text-info">No hay archivos en su intranet</p>
                @endif


              </div>
   

             <div>

        


        </div>
     
    </section>
</body>
</html>