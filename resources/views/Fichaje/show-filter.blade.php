
<div class="card">
    
              <div class="card-header">
                <h3 class="card-title">Establezca un rango de fechas para filtrar la actividad de fichajes</h3>
              </div>

              <form method="POST" action="{{ route('fichajes.filtrar.index') }}">
               @csrf
       
              <div class="card-body">

                <div class="row">
            
                    <div class="col">


                                   
                        <x-adminlte-input type="date" name="fecha_desde" label="Fecha desde" label-class="text-lightblue">
                
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-calendar-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                            
                        </x-adminlte-input>
            
                    </div>
   
          
                    <div class="col">

                
                        <x-adminlte-input type="date" name="fecha_hasta" label="Fecha hasta" label-class="text-lightblue">
                    
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lg fa-calendar-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                            
                        </x-adminlte-input>


                   
                    </div>

                </div>

                <div class="card-footer">
               
                <x-adminlte-button class="btn-flat" type="submit" label="Filtrar fichajes" theme="success" icon="fas fa-lg fa-search"/>

                </div>
              </form>
</div>
