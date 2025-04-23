<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    //asigna un centro de trabajo a un usuario
    public function updateUserCentro(Request $request){

        $usuarios = User::all();
        $usuario = User::find($request->id_usuario);

        //si hay mas de un usuario el rol asignado por defecto es el de usuario
        if(count($usuarios) > 1){
            $rolUsuario = Role::findByName('Usuario');
            $usuario->assignRole($rolUsuario);

        }
        //pero si por el contrario hay un solo usuario, el cúal sera el primer usuario del sistema, el rol asignado por defecto sera el de administrador
        else{
            $rolAdmin = Role::findByName('Administrador');
            $usuario->assignRole($rolAdmin);
        }

        $usuario->id_centro = $request->id_centro;

        $usuario->save();

        return redirect('dashboard');


    }
}
