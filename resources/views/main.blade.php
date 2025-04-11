<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            width: 100vw;
            height:100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'monospace', 'system-ui', 'sans-serif';
            background-color:oklch(98.7% 0.019 192.83);
        }
        header{
            postion:fixed;
            left:0;
            top:0;
            width: 100vw;
            height: 6vh;
            background-color: #333;
            outline:2px solid gray;
        }

        footer{
            color: white;
            position: fixed;
            left:0;
            bottom:0;
            width: 100vw;  
            text-align: center; 
            margin: 1px;
            padding: 3px;
            background-color: #333;
            outline:2px solid gray;

        }

        nav{
      

        }

        h1{
            font-size: 30px;
        }
        .titulo__text--1{
            color:rgb(245, 48, 3);
            font-family: 'Helvetica', 'system-ui', 'sans-serif';
            text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000; 
            font-size:clamp(5rem, 2vw + 1rem, 2.25rem);

        }
        .titulo__text--0{
            font-family: 'Helvetica', 'system-ui', 'sans-serif';
            color:oklch(98.7% 0.019 192.83);
            text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000; 
            font-size:clamp(5rem, 2vw + 1rem, 2.25rem);


        }
        .subtitulo__text{
            font-family: 'Helvetica', 'system-ui', 'sans-serif';
            text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000; 
            background:transparent;
            content: " ";
        }
        .menu{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: end;

        }

        .menu__a{
            color: white;
            text-decoration: none;
            padding: 6px;
            margin: 10px;

        }
        .menu__a:hover{
            color:rgb(245, 48, 3);
            outline:1px solid rgb(245, 48, 3);
            box-shadow: 0 0 0 1px rgb(245, 48, 3);
            border-radius: 5px;

            text-decoration: underline;
            text-underline-position: under; /* subrayado debajo del texto */
            text-underline-offset: 1px; 
            text-decoration-color: white;

        }

        main{

            top: 5vh;
            position: relative;
        }
        .titulo{
            position: absolute;
            top:0;
            left:0;
            width: 100vw;
            height: 30vh;
            outline:2px solid gray;

        }
        
        .seccion__logo{
            top:1px;
            position: relative;
            display: flex;
            flex-direction:column;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            color:white;
            
        }
        .seccion__logo--title{
    
            display: flex;
            flex-direction:row;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .descripcion{
            position: absolute;
            text-aling:center;
            
            color: white;   
            top:400px;
            left: 0;
            width: 100vw;
            height: auto;
            background-color: #333;
        }

        .logo{
            max-width: 75px;
            max-height:auto;
        }
        .descripcion__texto{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            text-align: center;
            outline:2px solid gray;

        }
        .descripcion__texto--titulo{
            padding:6px;
            text-align:left;
            font-size:clamp(3rem, 2vw + 1rem, 2.25rem);
 
        }

        .descripcion__texto--contenido{
            padding:6px;
            margin:6px;
            text-align:justify;
            hyphens: auto;
            line-height: 1.625;
            font-size:clamp(0.5rem, 2vw + 1rem, 1.5rem);
 
        }
        video {
            object-fit: contain;
            width: 100%;
            height: 100vh;
        }

    </style>
</head>
<body>
   
    <header>
        <nav>

        @if (Route::has('login'))
            <section class="menu">
                @auth
                    <a href="{{ url('/dashboard') }}" class="menu__a" >Inicio</a>
                @else
                    <a href="{{ route('login') }}" class="menu__a">Iniciar Sesión</a>

                    @if (Route::has('reagister'))
                        <a href="{{ url('/main-register') }}" class="menu__a">Registro</a>
                    @endif
                @endauth
                <a href="{{ url('/main-register') }}" class="menu__a">Registro</a>

            </section>
        @endif


        </nav>
    </header>

    <main>

     

        <section class="titulo">

        <video   autoplay loop muted playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">
            <source src="storage/video/landing-video.mp4" type="video/mp4">
    
            No se ha podido cargar el contenido del video.

        </video>
       
        <section class="seccion__logo">

            <article class="seccion__logo--title">
            <h1>
                <span class="titulo__text--0">Emple</span><span class="titulo__text--1">@Ravel</span>
            </h1> 
            <img src="storage/img/logo/logo.png" class="logo">

            </article>
     
             <h1 class="subtitulo__text">Mucho más que un portal del empleado...</h1>
        </section>

        </section>

        <section class="descripcion">

        <article class="descripcion__texto">



             <h2 class="descripcion__texto--titulo">¿Que es Emple@Ravel? -- ></h2>
           <article class="descripcion__texto--contenido">

           <p>
              <strong>
              Emple@Ravel es un sistema con una interfaz moderna y minimalista que hara que tu productividad aumente de forma exponencial. 

              </strong> 
            </p>

            <p>
                Para ello cuenta con herramientas para la gestión de proyectos y empleados el cual incluye potentes funcionalidades como la gestión de fichajes durante la jornada laboral, la creación y gestión documental de proyectos mediante una intranet documental

            </p>



           </article>
          
        </article>


        </section>
        
    </main>

    <footer>
        <span>&copy; 2025 Emplearavel - Desarrollado por Ignacio Palenque </span>
    </footer>
    
</body>
</html>