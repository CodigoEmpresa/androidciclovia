<?php
/**
 * Created by PhpStorm.
 * User: JONATHAN.CASTRO
 * Date: 20/11/2017
 * Time: 8:34 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corredor extends Model
{
    protected $table = 'corredor';
    protected $primaryKey = 'idCorredor';

    public function coordenadas() {
        return $this->hasMany('App\Coordenada', 'idCorredor');
    }

    public function puntos() {
        return $this->belongsToMany('App\Punto', 'corredor_punto', 'idCorredor', 'idPunto')
                    ->withPivot('nombreCP', 'descripcionCP', 'latitud', 'longitud');
    }
}