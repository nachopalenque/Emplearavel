<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear crentro</title>
</head>
<body>
<div class="card">
              <div class="card-header">
                <h3 class="card-title">Rellene los datos para el nuevo Centro Productivo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form" method="POST" action="{{ route('centro.store') }}">
              @csrf
              <div class="card-body">

                <div class="row">

                    <div class="col">

                    <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="Ingrese el nombre del Centro Productivo"  label-class="text-lightblue" value="{{ old('nombre') }}" >
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-user text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>

                    </div>

                    <div class="col">
                      
                    
               
                    <x-adminlte-input type="text" name="razon_social" label="Razón Social" placeholder="Ingrese la Razón Social de su empresa u organización" label-class="text-lightblue" value="{{ old('razon_social') }}">
            
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                    
                    </x-adminlte-input>
                    
                    </div>

                </div>

                <div class="row">

                    <div class="col">


                                    
                    <x-adminlte-input type="text" name="CIF" label="CIF" placeholder="Ingrese el CIF de su empresa u organización " label-class="text-lightblue" value="{{ old('CIF') }}">
            
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-address-card text-lightblue"></i>
                            </div>
                        </x-slot>
            
                    </x-adminlte-input>

                    </div>

                    <div class="col">


                              
                    <x-adminlte-input type="text" name="provincia" label="Provincia" placeholder="Ingrese la Provincia del Centro Productivo" label-class="text-lightblue" value="{{ old('provincia') }}">
            
                        <x-slot name="prependSlot">
                            <div class="input-group-text">
                                <i class="fas fa-map text-lightblue"></i>
                            </div>
                        </x-slot>
            
                    </x-adminlte-input>

                    
                    </div>

                </div>

                <div class="row">

                    <div class="col">


                                       
                        <x-adminlte-input type="text" name="localidad" label="Localidad" placeholder="Ingrese la localidad del Centro Productivo" label-class="text-lightblue" value="{{ old('localidad') }}">
                
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-home text-lightblue"></i>
                                </div>
                            </x-slot>
                
                        </x-adminlte-input>



                       
                     </div>

          
                    <div class="col">



                     
                                       
                            <x-adminlte-input type="text" name="codigo_postal" label="Código Postal" placeholder="Ingrese el código postal del Centro Productivo" label-class="text-lightblue" value="{{ old('codigo_postal') }}">
                                
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-compass text-lightblue"></i>
                                    </div>
                                </x-slot>
            
                            </x-adminlte-input>


                    </div>

                </div>



                <div class="row">
            
                    <div class="col">


                                       
                        <x-adminlte-input type="text" name="pais" label="País" placeholder="Ingrese el país del Centro Productivo" label-class="text-lightblue" value="{{ old('pais') }}">
                    
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-flag text-lightblue"></i>
                                </div>
                            </x-slot>
        
                        </x-adminlte-input>


                   

                    </div>

          
                    <div class="col">

            



                        <div class="form-group ">
                        <label class="text-lightblue">Estilo Corporativo</label>
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-palette text-lightblue"></i></span>
                        <select name="estilo"  class="form-control text-dark" id="estilo">
                            <option value="none">Por defecto</option>
                            <option value="light" style="background-color: white; color: black">Blanco</option>
                            <option value="bg-danger"style="background-color: red; color: white">Rojo</option>
                            <option value="bg-primary" style="background-color: #006db7; color: white">Azul</option>
                            <option value="bg-info" style="background-color: #0099e7; color: white">Azul claro</option>
                            <option value="bg-lightblue" style="background-color: rgba(0, 194, 251, 0.78); color: white">Azul claro celeste</option>
                            <option value="bg-navy" style="background-color: rgba(13, 29, 154, 0.78); color: white">Azul Oscuro</option>
                            <option value="bg-purple" style="background-color: rgba(73, 34, 148, 0.78); color: white">Morado</option>
                            <option value="bg-pink" style="background-color: rgba(252, 110, 212, 0.78); color: white">Rosa</option>
                            <option value="bg-fuchsia" style="background-color: rgba(232, 35, 189, 0.78); color: white">Fucsia</option>
                            <option value="bg-success" style="background-color: rgba(0, 205, 43, 0.78); color: white">Verde</option>
                            <option value="bg-teal" style="background-color: rgba(0, 216, 159, 0.78); color: white">Verde Turquesa</option>
                            <option value="bg-lime" style="background-color: rgba(0, 255, 69, 0.78); color: white">Verde Lima</option>
                            <option value="bg-olive" style="background-color: rgba(50, 174, 75, 0.78); color: white">Verde Olivo</option>
                            <option value="bg-maroon" style="background-color: maroon; color: white">Maroon</option>
                            <option value="bg-orange" style="background-color: orange; color: white">Naranja</option>
                            <option value="bg-warning" style="background-color: #e0b700; color: white">Amarillo</option>
                        </select>
                            </div>

                        </div>
                    </div>

                </div>


                 <div class="row">
       

          
                    <div class="col">

                        <x-adminlte-textarea name="direccion" label="Dirección" rows=3 label-class="text-lightblue"
                            igroup-size="sm" placeholder="Ingrese la Dirección del Centro Productivo" text="{{ old('direccion') }}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                     <i class="fas fa-address-book text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-textarea>

                    </div>


                </div>



                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <x-adminlte-button class="btn-flat" type="submit" label="Guardar Centro Productivo" theme="success" icon="fas fa-lg fa-save"/>
                <x-adminlte-button class="btn-flat" type="reset" label="Limpiar formulario" theme="danger" icon="fas fa-lg fa-trash"/>

                </div>
              </form>
</div>
</body>
</html>