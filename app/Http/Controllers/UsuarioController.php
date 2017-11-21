<?php
/**
 * Created by PhpStorm.
 * User: JONATHAN.CASTRO
 * Date: 20/11/2017
 * Time: 8:39 AM
 */

namespace App\Http\Controllers;


use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function obtener() {
        $usuario = Usuario::get();
        return response()->json(['usuarios' => $usuario]);
    }

    public function insertar(Request $request)
    {
        $estado = 0;
        $mensaje = '';
        $usuario = Usuario::where('email',$request->input("email"))->first();
        if(empty($usuario)){
            $usuario = new Usuario;
            $usuario->email = $request->input("email");
            $usuario->password = sha1($request->input("email").$request->input("password"));
            $usuario->save();
            $estado = 1;
            $mensaje = 'Se ha registrado correctamente';
        }else{
            if($usuario->password ==  sha1($usuario->email.$usuario->password)){
                $estado = 2;
                $mensaje = 'Se ha logeado correctamente';
            }else{
                $estado = 3;
                $mensaje = 'Contraseña invalida';
            }
        }

        return response()->json(['estado' => $estado, 'mensaje'=>$mensaje]);
    }
}