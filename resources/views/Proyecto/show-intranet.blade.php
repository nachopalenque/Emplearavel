<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <section class="content overflow-auto">
        <div class="container-fluid">
            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title">Listado de archivos:</h3>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    @if(count($documentos) > 0)
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
                                                <a href="{{ route('ver.archivo.proyecto', ['id' => $doc->id]) }}" class="text-info m-1" target="_blank" title="Ver documento"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('descarga.archivo.proyecto', ['id' => $doc->id]) }}" class="text-warning m-1" title="Descargar documento" download><i class="fas fa-download"></i></a>
                                                <button type="submit" title="Eliminar archivo" class="text-danger m-1 border-0 bg-transparent">
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

                <!-- Card Footer -->
                <div class="card-footer">
                    <form method="POST" action="{{ route('evento.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_proyecto" value="{{ $id }}">

                        <x-adminlte-input type="file" name="adjunto" label="Adjuntar archivo" label-class="text-lightblue" value="{{ old('adjunto') }}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-file text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        
                        <x-adminlte-button class="btn-flat" type="submit" label="Adjuntar archivo" theme="success" icon="fas fa-lg fa-save" />
                    </form>
                </div>

            </div> <!-- Cierre de card -->
        </div> <!-- Cierre de container-fluid -->
    </section>
</body>
</html>