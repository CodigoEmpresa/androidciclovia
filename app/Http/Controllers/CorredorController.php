<?php
/**
 * Created by PhpStorm.
 * User: JONATHAN.CASTRO
 * Date: 20/11/2017
 * Time: 8:39 AM
 */

namespace App\Http\Controllers;


use App\Corredor;

class CorredorController extends Controller
{
    public function obtener() {
        $corredores = Corredor::with('coordenadas', 'puntos')->get();

        return response()->json(['corredores' => $corredores]);
    }
}