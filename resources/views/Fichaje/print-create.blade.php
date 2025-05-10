<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de fichajes desde {{ $fecha_inicio }} hasta {{ $fecha_fin }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
        }
        h1, h3 {
            text-align: center;
        }
        span{
            text-decoration: underline;

        }
        .firma{
            float: right;
            text-align: center;
            padding: 8px;
            margin: 20px;
            width: 200px;
            height: 50px;
            font-weight: bold;
            border: 1px solid black;
        }
        .cabecera{
            text-align: left;
            padding: 8px;
            margin: 10px;
            width: 400px;
            font-weight: bold;
            border: 1px dotted black;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Listado de fichajes</h1>
        <h4 style="text-align: center;">Desde:  {{ $fecha_inicio }} hasta:  {{ $fecha_fin }}</h4>

        <div class="cabecera">
            <span>Datos de la empresa:</span>
            <h4>Razón social: {{ $razon_social }}</h4>
            <h4>CIF: {{ $cif }}</h4>
        </div>

        <div class="cabecera">
            <span>Datos del empleado:</span>
            <h4>Nombre y Apellidos: {{ $empleado }}</h4>
            <h4>DNI: {{ $dni }}</h4>
            <h4>Nº seguridad social: {{ $seguridad_social }}</h4>
        </div>
    
     
   

        <div class="card-header">
            <h3 class="card-title">Total fichajes: {{ count($fichajes) }}</h3>
            <hr>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Tiempo de Fichaje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fichajes as $fichaje)
                        <tr>
                            <td>{{ $fichaje->fecha_inicio }}</td>
                            <td>{{ $fichaje->fecha_fin }}</td>
                            <td>{{ $fichaje->tiempo_fichaje ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No se encontraron fichajes en este rango de fechas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">

            <div class="firma">
                <span>firma del trabajador :</span>
            </div>
            <div class="firma">
                <span>firma de la empresa :</span>
            </div>


        </div>

    </div>
</body>
</html>