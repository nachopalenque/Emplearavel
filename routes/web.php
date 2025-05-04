<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FichajeController;
use App\Http\Controllers\EmpleadoController;


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
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/centro', CentroController::class);
    Route::resource('/usuario', UserController::class);
    Route::resource('/fichaje', FichajeController::class);
    Route::get('/centro-auth', [CentroController::class,"showAuth"])->name('user.centro.showAuth');


});
