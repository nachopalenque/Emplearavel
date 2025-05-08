<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impresión de fichajes</title>
</head>
<body>
<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Elija el centro productivo al cual desea asociar el usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('fichaje.storePrint') }}">
              @csrf
              <div class="card-body">

                <div class="row">

                    <div class="col">
                    <div class="form-group ">
                            <label class="text-lightblue">Centros Productivos</label>
                         <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-city text-lightblue"></i></span>
                            <select name="centro" class="form-control text-dark" id="estilo">
                            
                            @foreach ($centros as $centro)
                                <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
                            @endforeach
                          
                            </select>
                         </div>

                        </div>
                    </div>

                  

              



                </div>
                <!-- /.card-body -->

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Cambiar usuario de centro productivo" theme="success" icon="fas fa-lg fa-print"/>

                </div>
              </form>
</div>
</body>
</html>