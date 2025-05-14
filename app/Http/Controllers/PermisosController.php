<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\UserController;
use App\Models\User;

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

                $permisoControlTotal = Permission::create(['name' => 'Control Total']);
                $permisoCrear = Permission::create(['name' => 'Crear']);
                $permisoEditar = Permission::create(['name' => 'Editar']);
                $permisoVer = Permission::create(['name' => 'Ver']);
                $permisoEliminar = Permission::create(['name' => 'Eliminar']);

                //Asigno los permisos a los roles
                //El rol admin tiene todos los permisos
                $rolAdmin->givePermissionTo($permisoControlTotal);
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

    public static function authAdmin(){
        try{

            if(auth()->user()->getRoleNames()->first() == 'Administrador'){

                return true;
                
            }else{

                return false;
    
            }

        }catch(Exception $e){

        return false;
        
        }
    }

    public function rolEditUser($id_usuario){
        try{
          
        $roles = Role::all();

        return view('Rol.edit-user-rol', ['roles' => $roles, 'id_usuario' => $id_usuario]);

        }catch(Exception $e){
            
        }
 
    }
    public function rolUpdateUser(Request $request){

        try{
            $usuario = User::find($request->id_usuario);
            $nuevoRol = Role::find($request->rol);
            $usuario->syncRoles($nuevoRol);
            $usuarios = UserController::usersRolCenter();

            return redirect()->route('usuario.index', ['usuarios' => $usuarios])->with('estado', 'actualizado');

        }catch(Exception $e){
            
        }
    }
}
