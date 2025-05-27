<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Escriba el nombre completo o parcial del asunto de la notificacion</h3><br>
                <span class="text-maroon">(Buscara todas las notificaciones que coincidan)</span>
              </div>

              <form method="POST" action="{{ route('notificacion.filtrar.index')  }}">
               @csrf
            
               <input type="text" name="tipo" value="{{$tipo}}" hidden="true">
              <div class="card-body">

                <div class="row">
            
                    <div class="col">
                    
                        
                        <x-adminlte-input type="text" name="titulo" label="Asunto" placeholder="Ingrese el asunto de la notificación"  label-class="text-lightblue" >
                
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-briefcase text-lightblue"></i>
                            </div>
                        </x-slot>
                        
                        </x-adminlte-input>

                                   
               
            
                    </div>
   
          

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Filtrar notificación" theme="success" icon="fas fa-lg fa-search"/>

                </div>
              </form>
</div>
