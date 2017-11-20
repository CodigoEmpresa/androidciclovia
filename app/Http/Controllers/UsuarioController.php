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

    public function insertar(Request $request) {
        $estado = 0;
        if(empty($request->input("id_usuario")))
            $usuario = new Usuario;
        else
            $usuario = Usuario::find($request->id_usuario);

        $usuario->email = $request->input("email");
        $usuario->password = sha1($request->input("email").$request->input("password"));
        $usuario->save();

        return response()->json(['estado' => 1]);
    }
}