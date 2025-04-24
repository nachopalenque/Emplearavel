<div>
<section class="content">
      <div class="container-fluid">
     
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total registros encontrados: {{ $items->count() }}</h3>

                <div class="card-tools">

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
                        @foreach($columnas as $columna)
                        <th>{{ $columna }}</th>
                         @endforeach
                     </tr>

                  </thead>
                  <tbody>
                
                      @foreach($items as $item)
                      <tr>
                        @foreach($columnas as $columna)
                        <td>{{ $item[$columna] }}</td>
                        @endforeach
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
