<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar rol de usuario</title>
</head>
<body>

<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Elija el rol el cual desea asociar el usuario</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('rol.edit-user.update') }}">
              @csrf
              <input type="text" name="id_usuario" value="{{$id_usuario}}" hidden="true">
              <div class="card-body">

                <div class="row">

                    <div class="col">
                    <div class="form-group ">
                            <label class="text-lightblue">Roles para usuarios</label>
                         <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-city text-lightblue"></i></span>
                            <select name="rol" class="form-control text-dark" id="estilo">
                            
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                          
                            </select>
                         </div>

                        </div>
                    </div>

                  

              



                </div>
                <!-- /.card-body -->

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Cambiar usuario de rol" theme="success" icon="fas fa-lg fa-print"/>

                </div>
              </form>
</div>
    
</body>
</html>