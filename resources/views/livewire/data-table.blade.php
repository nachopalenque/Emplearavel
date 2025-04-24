<div>
<section class="content">
      <div class="container-fluid">
     
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total registros encontrados: {{ $items->count() }}</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-block bg-gradient-success mb-3"><i class="fa fa-plus mr-1"></i>Nuevo Elemento</button>


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

                          @if($columna != 'Id')
                            <th>{{ $columna }}</th>
                          @endif

                         @endforeach

                         <th>Acciones</th>

                     </tr>

                  </thead>
                  <tbody>
                
                      @foreach($items as $item)
                      <tr id="{{ $item['id'] }}">
                        @foreach($columnas as $columna)

                          @if($columna !== 'id')
                          <td>{{ $item[$columna] }}</td>
                          @endif

                        @endforeach

                        <td class="text-left py-1 px-3 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info mr-2"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          </div>
                      </td>


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
