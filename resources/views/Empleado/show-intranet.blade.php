<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <section class="content">

        <div class="container-fluid">

            <div class="card">
              <div class="card-header">

              </div>

              <div class="card-body">

              <table class="table table-bordered">
                  <thead>

                      <tr>
                     
                     </tr>

                  </thead>
                  <tbody>
                        @foreach ($documentos as $doc)
                            <tr>
                                <td>{{ $doc->nombre }}</td>
                                <td>
                                    <a href="{{ $doc->adjunto }}" target="_blank">Ver</a>
                                    |
                                    <a href="{{ $doc->adjunto }}" download>Descargar</a>
                                </td>
                            </tr>
                        @endforeach
                  </tbody>

                </table>


              </div>
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                {{ $documentos->links() }}
                </ul>
              </div>

             <div>


        </div>

    </section>
</body>
</html>