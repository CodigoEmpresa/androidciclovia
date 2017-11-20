<?php
/**
 * Created by PhpStorm.
 * User: JONATHAN.CASTRO
 * Date: 20/11/2017
 * Time: 8:35 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Coordenada extends Model
{
    protected $table = 'coordenada';
    protected $primaryKey = 'idCoordenada';

    public function corredor() {
        return $this->belongsTo('App\Corredor', 'idCorredor');
    }
}