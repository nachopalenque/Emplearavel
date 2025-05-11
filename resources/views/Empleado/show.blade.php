@extends('adminlte::page')

@section('title', 'Ficha Empleado')

@section('content_header')
    <h1>Ficha Empleado</h1>
@stop

@section('content')
    <div class="card ">


                <!-- Modal Génerico-->

       <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered  modal-sm modal-md modal-lg modal-xl" role="document">
                  <div class="modal-content">
                    
                    <div class="modal-header">
                      <h5 class="modal-title" id="tituloModal"></h5>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    
                    <div id="modalBody" class="modal-body">

                    <!-- Código de llamada a la creación de un nuevo centro -->




                 

                    </div>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
                    </div>
                  
                  </div>
                </div>
      </div>






              <div class="card-header">
                <h3 class="card-title">Datos del empleado</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div id="map" style="width: 100%; height: 200px;"></div>
              <hr>

                <form>
                  <div class="row">


                    <div class="col-sm-6">
          
                    <x-adminlte-input type="text" name="nombre" label="Nombre"  label-class="text-lightblue" value="{{$empleado->nombre}}" disabled>
                    
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>



                    <div class="col-sm-6">
                      <!-- text input -->
                      <x-adminlte-input type="text" name="apellidos" label="Apellidos"  label-class="text-lightblue" value="{{$empleado->apellidos}}" disabled>
                    
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-id-badge text-lightblue"></i>
                              </div>
                          </x-slot>
                        
                      </x-adminlte-input>


                    </div>
         
                  </div>


                  <div class="row">

                     <div class="col-sm-6">
                        <!-- text input -->

                        <x-adminlte-input type="text" name="dni" label="DNI"  label-class="text-lightblue" value="{{$empleado->dni}}" disabled>
                    
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-id-card text-lightblue"></i>
                              </div>
                          </x-slot>
                  
                        </x-adminlte-input>


                     </div>
                        

                      <div class="col-sm-6">
                      <!-- text input -->
                        <x-adminlte-input type="text" name="seguridad_social" label="Código Seguridad Social"  label-class="text-lightblue" value="{{$empleado->seguridad_social}}" disabled>
                    
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-credit-card text-lightblue"></i>
                              </div>
                          </x-slot>
                        
                        </x-adminlte-input>

                     </div>





                    </div>


                  <div class="row">

                     <div class="col-sm-6">
                        <!-- text input -->
                        <x-adminlte-input type="text" name="telefono" label="Teléfono"  label-class="text-lightblue" value="{{$empleado->telefono}}" disabled>
                    
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-phone text-lightblue"></i>
                              </div>
                          </x-slot>
                  
                        </x-adminlte-input>
                    

                     </div>
                        

                      <div class="col-sm-6">
                      <!-- text input -->
                                                     
                        <x-adminlte-input type="text" name="provincia" label="Provincia"  label-class="text-lightblue" value="{{$empleado->provincia}}" disabled>
            
                          <x-slot name="prependSlot">
                              <div class="input-group-text">
                                  <i class="fas fa-map text-lightblue"></i>
                              </div>
                          </x-slot>

                        </x-adminlte-input>


                     </div>





                    </div>


                    <div class="row">


                        <div class="col-sm-6">
                        <!-- text input -->

                                       
                           <x-adminlte-input type="text" name="localidad" label="Localidad" label-class="text-lightblue" value="{{ $empleado->localidad }}" disabled>
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-home text-lightblue"></i>
                                    </div>
                                </x-slot>
    
                            </x-adminlte-input>



                        </div>


                        <div class="col-sm-6">
                      
                                                           
                          <x-adminlte-input type="text" name="pais" label="País"  label-class="text-lightblue" value="{{ $empleado->pais }}" disabled>
                              
                              <x-slot name="prependSlot">
                                  <div class="input-group-text">
                                      <i class="fas fa-flag text-lightblue"></i>
                                  </div>
                              </x-slot>

                          </x-adminlte-input>


                            
                        </div>





                    </div>







                    <div class="row">



                        <div class="col-sm-6">
                        <!-- text input -->
                                           
                            <x-adminlte-input type="text" name="codigo_postal" label="Código Postal"  label-class="text-lightblue" value="{{ $empleado->codigo_postal }}" disabled>
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-compass text-lightblue"></i>
                                    </div>
                                </x-slot>
            
                            </x-adminlte-input>

                        </div>


                        <div class="col-sm-6">

                                                      
                            <x-adminlte-input type="text" name="puesto" label="Puesto de trabajo" label-class="text-lightblue" value="{{ $empleado->puesto }}" disabled>
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-clipboard text-lightblue"></i>
                                    </div>
                                </x-slot>
            
                            </x-adminlte-input>





                        </div>

                     </div>





                    <div class="row">


                     

                        <div class="col-sm-6">
                        <!-- textarea -->

                        <x-adminlte-textarea name="direccion" label="Dirección" rows=3 label-class="text-lightblue"
                            igroup-size="sm" disabled >
                            {{ old('direccion', $empleado->direccion) }}
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-address-book text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>
                            
                        </div>



                        <div class="col-sm-6">
                        <!-- textarea -->


                        <label class="text-maroon">¿Que desea hacer?</label><br>
                        <x-adminlte-button class="btn-flat bg-gradient-info p-2 mt-4" 
                        id="btnVerCentro"
                        type="button" 
                        label="Ver centro productivo" 
                        theme="info" 
                        icon="fas fa-lg fa-city" 
                        data-id="{{ $empleado->user->id_centro }}"
                        data-toggle="modal" 
                        data-target="#modal"/>

                        <x-adminlte-button class="btn-flat bg-gradient-primary p-2 mt-4"
                        id="btnEditarEmpleado" 
                        type="button" 
                        label="Editar ficha del empleado" 
                        theme="primary" 
                        icon="fas fa-lg fa-user-edit" 
                        data-id="{{ $empleado->id }}"
                        data-toggle="modal" 
                        data-target="#modal"/>
                      
                        </div>





                    </div>


                    


                  </div>




@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    {{-- CSS de Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@stop



@push('js')

  @if (session('actualizado') == 'ok')
      <script>


        window.addEventListener('DOMContentLoaded', (event) => {
          mensajeConfirmacionActualizacionElemento();
          });
          
        </script>
  @endif

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  
  @php
    //en la variable dirección almaceno los campos que le voy a pasar como json a la api de openstreet map
    $direccion = "{$empleado->direccion}, {$empleado->localidad}, {$empleado->provincia}, {$empleado->pais}";
  @endphp

  <script>

    /* Escuchamos el evento que indica que el dom se ha cargado y ejecutamos una petición fetch  al api de openstreet map pasandole
       una constante llamada dirección, la cual va a contener en formato json los datos de la variable de php $direccion
    */
    document.addEventListener("DOMContentLoaded", function () {
        const direccion = @json($direccion);

        fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(direccion))
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    const lat = data[0].lat;
                    const lon = data[0].lon;

                    const mapa = L.map('map').setView([lat, lon], 15);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(mapa);

                    L.marker([lat, lon]).addTo(mapa)
                        .bindPopup(direccion)
                        .openPopup();
                } else {
                    console.error("Dirección no encontrada.");
                }
            })
            .catch(error => {
                console.error("Error al geocodificar:", error);
            });

            switch(@json(session('estado'))){
                
                case 'actualizado':
                    mensajeConfirmacionActualizacionElemento();
                    break;
            }
    });


    document.addEventListener('click', function (e) {



              // Botón: Editar Empleado
      if (e.target.closest('#btnEditarEmpleado')) {
          const btn = e.target.closest('#btnEditarEmpleado');
          const id = btn.dataset.id;
          console.log(id);
          document.getElementById('tituloModal').innerHTML = 'Editar Empleado';
          fetch(`/empleado/${id}/edit`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }

                    // Botón: Ver centro productivo
      if (e.target.closest('#btnVerCentro')) {
          const btn = e.target.closest('#btnVerCentro');
          const id = btn.dataset.id;
          document.getElementById('tituloModal').innerHTML = 'Datos centro productivo';
          fetch(`/centro/${id}`)
              .then(res => res.text())
              .then(html => {
                  document.getElementById('modalBody').innerHTML = html;
              });
      }




    });
  </script>        

@endpush
