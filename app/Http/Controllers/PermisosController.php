<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public static function plantillaRolesPermisos(){

        //Me obtengo tanto los roles como los permisos
        $roles = Role::all();
        $permisos = Permission::all();

        //Si no existe ningún rol creo la plantilla inicial de roles
        if(count($roles) == 0){
            $role = Role::create(['name' => 'Administrador']);
            $role = Role::create(['name' => 'ProductManager']);
            $role = Role::create(['name' => 'Usuario']);
        }

        //Si no existe ningún permiso creo la plantilla inicial de permisos
        if(count($permisos) == 0){
        
            $permiso = Permission::create(['name' => 'Crear']);
            $permiso = Permission::create(['name' => 'Editar']);
            $permiso = Permission::create(['name' => 'Ver']);
            $permiso = Permission::create(['name' => 'Eliminar']);
        }       

     

    }
}
