<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Datos Notificación</title>
</head>
<body>
    <div class="card">
              <div class="card-header">
                <h3 class="card-title">Datos Notificación</h3>
              </div>
              <!-- /.card-header -->

           <form method="POST" action="{{ route('notificacion.update', $notificacion->id) }}">
              @csrf
              @method('PUT')

              <div class="card-body">
                  <div class="row">

                    <div class="col-sm-6">

                      <x-adminlte-input type="text" name="remitente" label="Remitente"   label-class="text-lightblue"  value="{{$notificacion->remitente}}" disabled >
              
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-user text-lightblue"></i>
                            </div>
                        </x-slot>
                      
                      </x-adminlte-input>


                    </div>

                    <div class="col-sm-6">

                      <x-adminlte-input type="text" name="titulo" label="Asunto"   label-class="text-lightblue"  value="{{$notificacion->titulo}}" disabled >
              
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-briefcase text-lightblue"></i>
                            </div>
                        </x-slot>
                      
                      </x-adminlte-input>


                    </div>
         
                  </div>

               



                    <div class="row">





                     

                        <div class="col-sm-12">

                        <x-adminlte-textarea name="mensaje" label="Mensaje" rows=6 label-class="text-lightblue"
                            igroup-size="sm" disabled>
                            {{$notificacion->mensaje}}
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-pen-square text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>

                            
                        </div>





                    </div>





                    <div class="row">


                     

                        <div class="col-sm-12">
                    

                        <x-adminlte-textarea name="respuesta" label="Responder" rows=6 label-class="text-lightblue"
                            igroup-size="sm" >
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-pen-square text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>



                            
                        </div>





                    </div>



              </div>   
              
              <div class="card-footer">
                  <x-adminlte-button class="btn-flat" type="submit" label="Responder Notificación" theme="success" icon="fas fa-lg fa-save"/>
              </div>
              </form> 
    </div>

  
</body>
</html>