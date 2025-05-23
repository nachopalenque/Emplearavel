<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FichajeController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\TareasController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
});

//rutas para la creación del primer centro productivo y la asociación con los usuarios.
Route::get('/main-register', [CentroController::class,"centroPrincipal"]);
Route::post('/centro-Principal', [CentroController::class,"storePrincipal"])->name('centro-principal');
Route::get('/empleado-Usuario', [EmpleadoController::class,"createPrincipal"])->name('empleado-usuario');
Route::post('/empleado-Usuario', [EmpleadoController::class,"storePrincipal"])->name('empleado-usuario');


Route::get('/centro-Asociar-Usuario', [CentroController::class,"showUserCentro"])->name('centro-asociar-usuario');
Route::put('/centro-Asociar-Usuario', [UserController::class,"updateUserCentro"])->name('centro-asociar-usuario');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

//grupo de rutas solo accesibles tras la autentificación    
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //rutas para la gestion de los roles
    Route::get('/edit/rol/user/{id}', [PermisosController::class,"rolEditUser"])->name('rol.edit-user.edit');
    Route::post('/edit/rol/user', [PermisosController::class,"rolUpdateUser"])->name('rol.edit-user.update');

    //rutas para la gestion de los centros productivos
    Route::resource('/centro', CentroController::class);
    Route::get('/centro-auth', [CentroController::class,"showAuth"])->name('user.centro.showAuth');

    //rutas para la gestion de los usuarios
    Route::resource('/usuario', UserController::class);
    Route::get('/usuario/cambiarCentro/{id}', [UserController::class,"editUserCenter"])->name('user.centro.edit');
    Route::post('/usuario/cambiarCentro', [UserController::class,"updateUserCenter"])->name('user.centro.update');

    //rutas para la gestion de los proyectos
    Route::resource('/proyecto', ProyectoController::class);
    Route::get('/proyecto/intranet/docs/{id}', [ProyectoController::class,"showDocs"])->name('proyecto.intranet.show');
    Route::get('/proyecto/incluir/empleados/{id}', [ProyectoController::class,"editProyectoEmpleado"])->name('proyecto.empleados.edit');
    Route::get('/proyecto/empleados/{id}', [ProyectoController::class,"showProyectoEmpleado"])->name('proyecto.empleados.show');
    Route::get('/proyecto/evento/empleados/{id}', [ProyectoController::class,"createEvent"])->name('proyecto.evento.empleados.create');
    Route::post('/proyecto/evento/empleados', [ProyectoController::class,"storeEvent"])->name('proyecto.evento.empleados.store');
    Route::post('/proyecto/empleados/{id_proyecto}/{id_empleado}', [ProyectoController::class,"storeProyectoEmpleado"])->name('proyecto.empleados.store');
    Route::delete('/proyecto/empleados/{id_proyecto}/{id_empleado}', [ProyectoController::class,"destroyProyectoEmpleado"])->name('proyecto.empleados.destroy');
    //rutas para la gestion de los fichajes
    Route::resource('/fichaje', FichajeController::class);
    Route::get('/fichar', [FichajeController::class,"fichar"])->name('fichaje.fichar');
    Route::get('/terminar-fichar', [FichajeController::class,"terminarFichar"])->name('fichaje.terminarFichar');
    Route::get('/fichaje-print', [FichajeController::class,"indexPrint"])->name('fichaje.indexPrint');
    Route::post('/fichaje-print', [FichajeController::class,"storePrint"])->name('fichaje.storePrint');

    //rutas para la gestion de los empleados
    Route::resource('/empleado',EmpleadoController::class);
    Route::get('/empleado-auth', [EmpleadoController::class,"showAuth"])->name('empleado.showAuth');
    Route::get('/empleado/intranet/docs', [EmpleadoController::class,"showDocs"])->name('empleado.intranet.show');

    //rutas para la gestion de los eventos
    Route::resource('/evento',EventoController::class);
    Route::get('/evento/empleado/create/{id}', [EventoController::class,"create"])->name('evento.empleado.create');


   //rutas para gestionar archivos con seguridad
    Route::get('/descargar/archivo/{id}', [ArchivoController::class,"descargaArchivoEmpleado"])
    ->name('descarga.archivo.empleado');

    Route::get('/ver/archivo/{id}', [ArchivoController::class,"verArchivoEmpleado"])
    ->name('ver.archivo.empleado');

    Route::get('/descargar/archivo/proyecto/{id}', [ArchivoController::class,"descargaArchivoProyecto"])
    ->name('descarga.archivo.proyecto');

    Route::get('/ver/archivo/proyecto/{id}', [ArchivoController::class,"verArchivoProyecto"])
    ->name('ver.archivo.proyecto');

    //rutas para gestionar las tareas
    Route::resource('/tareas', TareasController::class);


});
