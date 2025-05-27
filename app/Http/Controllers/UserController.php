<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Centro;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EventoController;


class UserController extends Controller
{



    //asigna un centro de trabajo a un usuario
    public function updateUserCentro(Request $request){

        try{

            $usuarios = User::all();
            $centro = Centro::find($request->id_centro);
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
            //creamos una carpeta en la intranet documental para el nuevo usuario con su nombre de empleado.
            Storage::disk('local')->makeDirectory('intranet/'.$centro->nombre.'/empleados/'.$usuario->empleado->nombre);

            $usuario->save();
            EventoController::createNotificacionEvent('empleado_centro_nuevo', null, $centro, $usuario);
            return redirect('dashboard');

        }catch(Exception $e){

                    
          return response()->json(['error' => $e->getMessage()], 500);   

        }

    


    }

    public function index(){

        try{
            if(PermisosController::authAdmin()){

                //$usuarios = User::all();
                $usuarios = $this->usersRolCenter();
                return view('User.index', ['usuarios' => $usuarios]);
                
            }


        }
        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }

    }

    public static function usersRolCenter(){
        try{

           $usuarios = DB::table('users')
                ->join('centros', 'users.id_centro', '=', 'centros.id')
                ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->select(
                    'users.id',
                    'users.id_centro',
                    'users.name',
                    'users.email',
                    'users.password',
                    'centros.nombre as centro_nombre',
                    'roles.name as rol_nombre',
                    'users.created_at',
                    'users.updated_at'
                )
                ->groupBy(
                    'users.id',
                    'users.id_centro',
                    'users.name',
                    'users.email',
                    'users.password',
                    'centros.nombre',
                    'roles.name',
                    'users.created_at',
                    'users.updated_at'
                )
                ->paginate(10);
                return $usuarios;


        }catch(Exception $e){
                
                return response()->json(['error' => $e->getMessage()], 500);   

        }
    }
    public function editUserCenter($id_usuario){
        try{

            $centros = Centro::all();
            return view('User.edit-centro', ['centros' => $centros, 'id_usuario' => $id_usuario]);

        }catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }
    }

    public function updateUserCenter(Request $request){
        
        try{

            //cargo los datos del usuario
            $user = User::find($request->id_usuario);
            //cargo el nombre del centro productivo al que vamos a cambiar al usuario
            $centro = Centro::find($request->centro)->nombre;

            //movemos la carpeta del empleado en la intranet al centro productivo de cambio
            $origen = 'intranet/'.$user->centro->nombre.'/empleados/'.$user->empleado->nombre;
            $destino =  'intranet/'.$centro.'/empleados/'.$user->empleado->nombre;;
            Storage::disk('local')->move($origen, $destino);


            //cambiamos el id_centro de usuario al nuevo
            $user->id_centro = $request->centro;
            $user->save();
            //volvemos a cargar los usuarios, centros y roles
            $usuarios = $this->usersRolCenter();
            return redirect()->route('usuario.index', ['usuarios' => $usuarios])->with('estado', 'actualizado');
        }

        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }
    }   

    public function destroy($id){
        try{

            $user = User::find($id);
            $intranetUsuario = 'intranet/'.$user->centro->nombre.'/empleados/'.$user->empleado->nombre;
            if (Storage::exists($intranetUsuario)) {
                Storage::deleteDirectory($intranetUsuario);
             }
            $user->delete();
            return redirect()->route('usuario.index')->with('estado', 'eliminado');
        }
        catch(Exception $e){
                    
          return response()->json(['error' => $e->getMessage()], 500);   
        }
    }
}
