<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Escriba el nombre completo o parcial del proyecto</h3><br>
                <span class="text-maroon">(Buscara todos los proyectos que coincidan)</span>
              </div>

              <form method="POST" action="{{ route('proyectos.filtrar.index') }}">
               @csrf
       
              <div class="card-body">

                <div class="row">
            
                    <div class="col">
                    
                        
                        <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="Ingrese el nombre del Proyecto"  label-class="text-lightblue" >
                
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-briefcase text-lightblue"></i>
                            </div>
                        </x-slot>
                        
                        </x-adminlte-input>

                                   
               
            
                    </div>
   
          

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Filtrar proyectos" theme="success" icon="fas fa-lg fa-search"/>

                </div>
              </form>
</div>
