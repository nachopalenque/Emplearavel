
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Datos Centro Productivo</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 2rem;
    }

    .card {
      background-color: #fff;
      border-radius: 8px;
      max-width: 900px;
      margin: 0 auto;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .card--info {
      background-color: #fff;
      border-radius: 8px;
      max-width: 900px;
      margin: 20px auto;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #343a40;
      color: #fff;
      padding: 1rem 1.5rem;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .card-header--info {
      background-color: oklch(0.52 0.1 164.65);
      color: #fff;
      padding: 0.5rem 1.5rem;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }


    .info-group {
      padding: 1.5rem;
      margin-bottom: 1.2rem;
    }

    .info-group span {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    .card-header h3 {
      margin: 0;
      font-size: 1.2rem;
    }

    .card-body {
      padding: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.2rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    .form-control {
      width: 100%;
      padding: 0.5rem 0.75rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      background-color: #e9ecef;
      color: #495057;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .col {
      flex: 1 1 45%;
      min-width: 250px;
    }

    textarea.form-control {
      resize: vertical;
    }

    .form-actions {
      text-align: right;
      margin-top: 1.5rem;
    }

    .btn {
      padding: 0.6rem 1.2rem;
      border: none;
      background-color: oklch(0.52 0.1 164.65);
      color: #fff;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    h1{
        color:green;
        text-align: justify;
        padding: 3;
        margin:3;
    }

    .form-control:focus {
        border-color: oklch(0.52 0.1 164.65); /* el color que tú quieras */
        outline: none; /* quita el borde azul de algunos navegadores */
        box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.2); /* sombra opcional */
    }

    .btn:hover {
      background-color: darkgreen;
    }

    @media (max-width: 600px) {
      .col {
        flex: 1 1 100%;
      }

      .form-actions {
        text-align: center;
      }
    }
  </style>
</head>
<body>
    <div class="card--info">

        <div class="card-header--info">
        <h3>Antes de nada...</h3>
        </div>

        <div class="info-group">
        <span>Debe crear al menos un centro productivo para empezar a trabajar. A continuación rellene los datos para ello.</span>
        </div>


    </div>


  <div class="card">
    <div class="card-header">
      <h3>Datos Centro Productivo</h3>
    </div>
    <div class="card-body">
      <form action="{{route('centro-principal')}}" method="post">
      @csrf
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre del Centro Productivo"  />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Razón Social</label>
              <input type="text" name="razon_social" class="form-control" placeholder="Ingrese la Razón Social de su empresa u organización" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>CIF</label>
              <input type="text" name="CIF" class="form-control" placeholder="Ingrese el CIF de su empresa u organización " />
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label>Provincia</label>
              <input type="text" name="provincia" class="form-control" placeholder="Ingrese la Provincia del Centro Productivo" />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Localidad</label>
              <input type="text" name="localidad" class="form-control" placeholder="Ingrese la Localidad del Centro Productivo" />
            </div>
          </div>

          
          <div class="col">
            <div class="form-group">
              <label>Código Postal</label>
              <input type="text" name="codigo_postal" class="form-control"  placeholder="Ingrese el Código Postal del Centro Productivo" />
            </div>
          </div>
        </div>



        <div class="row">
       

        <div class="col">
            <div class="form-group">
              <label>País</label>
              <input type="text" name="pais" class="form-control" placeholder="Ingrese el País del Centro Productivo"  />
            </div>
          </div>

          
          <div class="col">
            <div class="form-group">
              <label>Estilo Corporativo</label>

              <select name="estilo"  class="form-control" id="estilo">
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


        <div class="row">
       

          
          <div class="col">
            <div class="form-group">
              <label>Dirección</label>
              <textarea class="form-control" name="direccion" rows="3" placeholder="Ingrese la Dirección del Centro Productivo" ></textarea>
            </div>
          </div>


        </div>



        <div class="form-actions">
          <button type="submit" class="btn">Crear Centro Productivo</button>
        </div>


      </form>
    </div>
  </div>

</body>
</html>