<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Escriba el nombre completo o parcial de la tarea</h3><br>
                <span class="text-maroon">(Buscara todas las tareas que coincidan)</span>
              </div>

              <form method="POST" action="{{ route('tareas.filtrar.index') }}">
               @csrf
       
              <div class="card-body">

                <div class="row">
            
                    <div class="col">
                    
                        
                        <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="Ingrese el nombre de la tarea"  label-class="text-lightblue" >
                
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-briefcase text-lightblue"></i>
                            </div>
                        </x-slot>
                        
                        </x-adminlte-input>

                                   
               
            
                    </div>
   
          

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Filtrar tareas" theme="success" icon="fas fa-lg fa-sync-alt"/>

                </div>
              </form>
</div>
