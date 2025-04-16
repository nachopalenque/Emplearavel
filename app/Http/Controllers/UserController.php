<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    //asigna un centro de trabajo a un usuario
    public function updateUserCentro(Request $request){

        $usuario = User::find($request->id_usuario);

        $usuario->id_centro = $request->id_centro;

        $usuario->save();

        return redirect('dashboard');


    }
}
