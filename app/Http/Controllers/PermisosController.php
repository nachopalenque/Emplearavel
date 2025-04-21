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
            $rolAdmin = Role::create(['name' => 'Administrador']);
            $rolPm = Role::create(['name' => 'ProductManager']);
            $rolUsuario = Role::create(['name' => 'Usuario']);


            //Si no existe ningún permiso creo la plantilla inicial de permisos
            if(count($permisos) == 0){
            
                $permisoCrear = Permission::create(['name' => 'Crear']);
                $permisoEditar = Permission::create(['name' => 'Editar']);
                $permisoVer = Permission::create(['name' => 'Ver']);
                $permisoEliminar = Permission::create(['name' => 'Eliminar']);

                //Asigno los permisos a los roles
                //El rol admin tiene todos los permisos
                $rolAdmin->givePermissionTo($permisoCrear);
                $rolAdmin->givePermissionTo($permisoEditar);
                $rolAdmin->givePermissionTo($permisoVer);
                $rolAdmin->givePermissionTo($permisoEliminar);

                //rolPm solo tiene el permiso crear y editar
                $rolPm->givePermissionTo($permisoCrear);
                $rolPm->givePermissionTo($permisoVer);
                $rolPm->givePermissionTo($permisoEditar);


                //rolUsuario solo tiene el permiso ver
                $rolUsuario->givePermissionTo($permisoVer);


                
            }
        
        
        }


     

    }
}
