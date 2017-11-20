<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/autenticar', function(){
	return 'test ok';
});

//api
$app->post('/persona/verificar', 'ServicesController@verificar');
$app->post('/persona/autenticar', 'ServicesController@autenticar');
$app->post('/noticias/obtener', 'ServicesController@noticias');
$app->post('/eventos/obtener', 'ServicesController@eventos');
$app->post('/recomendaciones/obtener', 'ServicesController@recomendaciones');
$app->post('/noticias/detalle', 'ServicesController@detalleNoticia');
$app->post('/noticias/total', 'ServicesController@totalNoticias');
$app->post('/mensajes/obtener', 'ServicesController@mensajes');
$app->post('/mensajes/total', 'ServicesController@totalMensajes');
$app->post('/mensajes/insertar', 'ServicesController@insertarMensaje');
$app->post('/bicicorredores/obtener', 'ServicesController@bicicorredores');
$app->post('/bicicorredores/total', 'ServicesController@totalBicicorredores');
$app->post('/bicicorredores/detalle', 'ServicesController@detalleCorredor');
$app->post('/bicicorredores/geo', 'ServicesController@geoCorredor');
$app->post('/bicicorredores/puntos', 'ServicesController@puntosCorredor');
$app->post('/bicicorredores/puntos/detalle', 'ServicesController@detallePuntoCorredor');
$app->post('/visita/insertar', 'ServicesController@visita');
$app->post('/problema/insertar', 'ServicesController@problema');

//assets
$app->get('/mapaciclovia', function()
{
	return response()->download('public/img/'.date('Y').'/mapa_ciclovia.jpg');
});

