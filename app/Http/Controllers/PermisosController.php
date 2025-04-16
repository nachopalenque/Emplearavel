<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisosController extends Controller
{
    public static function plantillaRolesPermisos(){

        $role = Role::create(['name' => 'Administrador']);
        $role = Role::create(['name' => 'ProductManager']);
        $role = Role::create(['name' => 'Usuario']);
        $permiso = Permission::create(['name' => 'Crear']);
        $permiso = Permission::create(['name' => 'Editar']);
        $permiso = Permission::create(['name' => 'Ver']);
        $permiso = Permission::create(['name' => 'Eliminar']);

    }
}
