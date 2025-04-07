<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EMPLE@RAVEL</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        /* Estilos para el header */

        body{
            background-color: #333;

            overflow: hidden;
        }
        .fondo{
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%'%3E%3Crect x='0' y='0' width='100%' height='100%' fill='%23f0f0f0'/%3E%3C/svg%3E");
            background-color: #333;
            background-size: cover;
            background-position: center;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 50px;
        }

        .title {
            position: relative;
            margin: 0;
            top: 100px;
            padding: 0;
            width: 100vw;

            
        }

        .about{

            width: 100%;
            right: 0;
            left: 0;
            padding: 1em;
            text-align: center;
            background-color: #333;
            display: flex;
            flex-direction: row;
            flex-wrap:wrap;
            justify-content: center;
            align-items: center;
        }

        /* Estilos para el texto centrado */
        .texto-centrado {
            text-align: center;
        }


        .contenedor-texto--dark .texto-centrado {
            width: 80%; /* ajusta el ancho según sea necesario */
            text-align: center;
            margin: 0 auto;
            }


        /* Estilos para el contenido del header */
        header div {
            margin: 0 1em;
        }

        /* Estilos para el enlace de inicio */
        .inicio {
            font-weight: bold;
            color: white;
            text-decoration: none;
        }

        .inicio:hover {
            color: darkred;
        }

        /* Estilos para el enlace de registro */
        .registro {
            font-weight: bold;
            color: white;
            text-decoration: none;
            margin-left: 1em;
        }

        .registro:hover {
            color: darkred;
        }

        /* Estilos para la sección principal */
        .principal {
            postion:relative;
            max-width: 100vw;
            margin: 0 auto;
        }

        /* Estilos para el logo */
        .logo {
            width: 80%;
            height:500px;
            margin: 0 auto;
        }

        /* Estilos para el título */
        .titulo {
            font-size: 48px;
            color: #333;
            margin-bottom: 1em;
        }

        /* Estilos para el texto de descripción */
        .descripcion {
            font-size: 18px;
            color: #666;
            margin-bottom: 2em;
        }

        /* Estilos para el pie de página */
        .pie {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
            clear: both;
        }

        /* Estilos para el texto del pie de página */
        .pie-texto {
            font-size: 14px;
            color: #666;
        }

        /* Estilos para el enlace del pie de página */
        .pie-enlace {
            font-weight: bold;
            color: #666;
            text-decoration: none;
        }

        .pie-enlace:hover {
            color: #999;
        }

        /* Media queries para responsividad */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
            }

            header div {
                margin: 0.5em 0;
            }

            .principal {
                max-width:100%;
                padding: 0.5em;
            }

            .logo {
                width: 50%;
                height: auto;
            }

            .titulo {
                font-size: 36px;
            }

            .descripcion {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <section class="fondo">
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" viewBox="0 0 1422 800" opacity="0.47"><defs><linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="oooscillate-grad"><stop stop-color="hsl(353, 98%, 41%)" stop-opacity="1" offset="0%"></stop><stop stop-color="hsl(212, 72%, 59%)" stop-opacity="1" offset="100%"></stop></linearGradient></defs><g stroke-width="2" stroke="url(#oooscillate-grad)" fill="none" stroke-linecap="round"><path d="M 0 572 Q 355.5 -100 711 400 Q 1066.5 900 1422 572" opacity="0.16"></path><path d="M 0 550 Q 355.5 -100 711 400 Q 1066.5 900 1422 550" opacity="0.53"></path><path d="M 0 528 Q 355.5 -100 711 400 Q 1066.5 900 1422 528" opacity="0.28"></path><path d="M 0 506 Q 355.5 -100 711 400 Q 1066.5 900 1422 506" opacity="0.79"></path><path d="M 0 484 Q 355.5 -100 711 400 Q 1066.5 900 1422 484" opacity="0.51"></path><path d="M 0 462 Q 355.5 -100 711 400 Q 1066.5 900 1422 462" opacity="0.80"></path><path d="M 0 440 Q 355.5 -100 711 400 Q 1066.5 900 1422 440" opacity="0.78"></path><path d="M 0 418 Q 355.5 -100 711 400 Q 1066.5 900 1422 418" opacity="0.58"></path><path d="M 0 396 Q 355.5 -100 711 400 Q 1066.5 900 1422 396" opacity="0.62"></path><path d="M 0 374 Q 355.5 -100 711 400 Q 1066.5 900 1422 374" opacity="0.39"></path><path d="M 0 352 Q 355.5 -100 711 400 Q 1066.5 900 1422 352" opacity="0.79"></path><path d="M 0 330 Q 355.5 -100 711 400 Q 1066.5 900 1422 330" opacity="0.88"></path><path d="M 0 308 Q 355.5 -100 711 400 Q 1066.5 900 1422 308" opacity="0.63"></path><path d="M 0 286 Q 355.5 -100 711 400 Q 1066.5 900 1422 286" opacity="0.80"></path><path d="M 0 264 Q 355.5 -100 711 400 Q 1066.5 900 1422 264" opacity="0.11"></path><path d="M 0 242 Q 355.5 -100 711 400 Q 1066.5 900 1422 242" opacity="0.24"></path><path d="M 0 220 Q 355.5 -100 711 400 Q 1066.5 900 1422 220" opacity="0.66"></path><path d="M 0 198 Q 355.5 -100 711 400 Q 1066.5 900 1422 198" opacity="0.47"></path><path d="M 0 176 Q 355.5 -100 711 400 Q 1066.5 900 1422 176" opacity="0.15"></path><path d="M 0 154 Q 355.5 -100 711 400 Q 1066.5 900 1422 154" opacity="0.78"></path><path d="M 0 132 Q 355.5 -100 711 400 Q 1066.5 900 1422 132" opacity="0.70"></path><path d="M 0 110 Q 355.5 -100 711 400 Q 1066.5 900 1422 110" opacity="0.80"></path><path d="M 0 88 Q 355.5 -100 711 400 Q 1066.5 900 1422 88" opacity="0.43"></path><path d="M 0 66 Q 355.5 -100 711 400 Q 1066.5 900 1422 66" opacity="0.63"></path><path d="M 0 44 Q 355.5 -100 711 400 Q 1066.5 900 1422 44" opacity="0.76"></path></g></svg>
    <header>
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="inicio">Inicio</a>
                @else
                    <a href="{{ route('login') }}" class="inicio">Log in</a>

                    @if (Route::has('reagister'))
                        <a href="{{ route('register') }}" class="registro">Registro</a>
                    @endif
                @endauth
                <a href="{{ route('register') }}" class="registro">Dar de alta centro</a>

            </div>
            <hr>
        @endif
    </header>

    <main class="principal">

    <section class="title">
<section class="principal" style="position: relative;">

    <video class="contenedor-video" src="storage/video/landing-video.mp4" autoplay loop muted playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;"></video>

    <div class="contenedor-texto" style="position: relative; z-index: 1;">
        <img src="storage/img/logo/emplearavel.webp" class="logo">
    </div>
</section>

    <section class="about">

            <h2 class="titulo texto-centrado">¿Que es Emple@ravel?</h2>
            <p class="descripcion text-centrado">
                Emplearavel es un sistema de gestión de proyectos y empleados con funcionalidades tales como el fichaje
            </p>


    </section>


     

 


   

            <div class="contenedor-texto">
            <div class="texto-centrador">
                &nbsp;
            </div>



            <div class="texto-centrado">
                    Desarrollado en Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>



    </main>
           

   
    </body>
</html>
