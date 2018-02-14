<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Carbon\Carbon as Carbon;
use DB;

class ServicesController extends BaseController {

    public function verificar(Request $request)
    {
    	$identificacion = $request->input('Identificacion');
		$nombre = $request->input('Nombre');

		$existe = DB::select('CALL __SP_Persona(?, ?, ?, ?)', ['1', '', $identificacion, $nombre]);
	
		if ($existe[0]->Respuesta == '1-')
		{
			$persona = DB::select('CALL __SP_Persona(?, ?, ?, ?)', ['3', '', $identificacion, $nombre]);
			$id = $persona[0]->idPersona;

			DB::statement('CALL __SP_Persona(?, ?, ?, ?)', ['4', $id, $identificacion, $nombre]);
		} else {
			DB::statement('CALL __SP_Persona(?, ?, ?, ?)', ['2', '', $identificacion, $nombre]);
		}

		return response()->json([1]);
    }

    public function autenticar(Request $request)
    {
    	$identificacion = $request->input('Identificacion');
    	$persona = DB::select('CALL __SP_Persona(?, ?, ?, ?)', ['3', '', $identificacion, '']);

    	return response()->json([$persona[0]->idPersona]);
    }

    public function noticias(Request $request)
    {
    	$noticias = DB::select('CALL __SP_Noticia(?, ?, ?, ?, ?, ?, ?)', ['2', '', '', '', '', '', '']);
		
		return response()->json($noticias);
    }

    public function eventos(Request $request)
    {
    	$eventos = DB::select('SELECT * FROM evento ORDER BY fechaInicio DESC, prioridad DESC LIMIT 0, 50');
    	$eventos_por_dia = [];

    	foreach ($eventos as $evento) 
    	{
    		$fecha = Carbon::createFromFormat('Y-m-d H:i:s', $evento->fechaInicio);
    		$key = $fecha->format('Y-m-d');

    		$eventos_por_dia[$key][] = $evento;
    	}
		
		return response()->json($eventos_por_dia);
    }

    public function recomendaciones(Request $request)
    {
    	$recomendaciones = DB::select('SELECT imgRecomendacion as src, descripcion as sub FROM recomendacion ORDER BY idRecomendacion DESC LIMIT 0, 60');
		
		return response()->json($recomendaciones);
    }

    public function detalleNoticia(Request $request)
    {
    	$id_noticia= $_POST["idNoticia"];
		$noticia = DB::select('CALL __SP_Noticia(?, ?, ?, ?, ?, ?, ?)', ['4', $id_noticia, '', '', '', '', '']);

		if (count($noticia) > 0)
			return response()->json($noticia[0]);
		else 
			return response()->json([0]);
    }

    public function totalNoticias(Request $request)
    {
    	$noticias = DB::select('CALL __SP_Noticia(?, ?, ?, ?, ?, ?, ?)', ['1', '', '', '', '', '', '']);
		
		return response()->json([$noticias[0]->Resultado]);
    }

    public function mensajes(Request $request)
    {
    	$mensajes = DB::select('CALL __SP_Mensaje(?, ?, ?, ?)', ['2', '', '', '']);

    	return response()->json($mensajes);
    }

    public function totalMensajes(Request $request)
    {
    	$mensajes = DB::select('CALL __SP_Mensaje(?, ?, ?, ?)', ['1', '', '', '']);

    	return response()->json($mensajes[0]->Resultado);
    }

	public function insertarMensaje(Request $request)
	{
		$mensaje = $request->input("_Mensaje");
		$id_persona = $request->input("_idPersona");
		DB::statement('CALL __SP_Mensaje(?, ?, ?, ?)', ['3', '', $mensaje, $id_persona]);

		return response()->json([1]);
	}

	public function bicicorredores(Request $request)
	{
		$bicicorredores = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['2', '', '', '', '', '', '']);
		foreach ($bicicorredores as &$bicicorredor) 
		{
			$geolocalizacion = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['4', $bicicorredor->idCorredor, '', '', '', '', '']);
			$puntos = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['6', $bicicorredor->idCorredor, '', '', '', '', '']);
			$bicicorredor->geolocalizacion = $geolocalizacion;
			$bicicorredor->puntos = $puntos;
		}

		return response()->json($bicicorredores);
	}

	public function totalBicicorredores(Request $request)
	{
		$bicicorredores = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['1', '', '', '', '', '', '']);

		return response()->json($bicicorredores[0]->Resultado);	
	}

	public function detalleCorredor(Request $request)
	{	
		$id_corredor = $_POST["idCorredor"];
		$bicicorredor = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['3', $id_corredor, '', '', '', '', '']);
		
		if (count($bicicorredor) > 0)
			return response()->json($bicicorredor[0]);
		else
			return response()->json([0]);
	}

	public function geoCorredor(Request $request)
	{
		$id_corredor = $_POST["idCorredor"];
		$bicicorredor = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['4', $id_corredor, '', '', '', '', '']);
		
		if (count($bicicorredor) > 0)
			return response()->json($bicicorredor);
		else
			return response()->json([0]);
	}

	public function puntosCorredor(Request $request)
	{
		$id_corredor = $_POST["idCorredor"];
		$puntos = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['6', $id_corredor, '', '', '', '', '']);

		return response()->json($puntos);
	}

	public function detallePuntoCorredor(Request $request)
	{
		$id_corredor = $_POST["idCorredor"];
		$id_punto = $_POST["idPunto"];	
		$punto = DB::select('CALL __SP_Corredor(?, ?, ?, ?, ?, ?, ?)', ['5', $id_corredor, '', '', '', '', $id_punto]);

		return response()->json($punto[0]);
	}

	public function visita(Request $request)
	{
		DB::statement('CALL __SP_Visita(?, ?, ?)', ['2', '', '']);

		return response()->json([1]);
	}

	public function problema(Request $request)
	{
		$descripcion= $_POST["_descripcion"];
        $imagen= $_POST["_imagen"];
        DB::statement('CALL __SP_Problema(?, ?, ?, ?)', ['1', '', $descripcion, $imagen]);

        return response()->json([1]);
	}
}