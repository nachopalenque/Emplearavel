
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
        <h3>Ya casi esta...</h3>
        </div>

        <div class="info-group">
        <span>Por último asocie el usuario {{$usuario->name}} al Centro Productivo para empezar a trabajar</span>
        </div>


    </div>


  <div class="card">
    <div class="card-header">
      <h3>Datos Centro Productivo</h3>
    </div>
    <div class="card-body">
      <form action="{{route('centro-asociar-usuario')}}" method="post">
      @method("PUT")
      @csrf
   



        <div class="row">
       
        <input type="hidden" name="id_usuario" value="{{$usuario->id}}"  class="form-control" id="usuario" hidden>

          
          <div class="col">
            <div class="form-group">
              <label>Centros Productivos</label>

              <select name="id_centro"  class="form-control" id="centro">
                @foreach ($centros as $centro) 
                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                @endforeach
              </select>

            </div>

            <div class="form-actions">
            <button type="submit" class="btn">Añadir usuario al centro productivo</button>
            </div>
          

          </div>

                

        </div>


   

      </form>
  </div>

</body>
</html>