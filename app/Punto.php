<?php
/**
 * Created by PhpStorm.
 * User: JONATHAN.CASTRO
 * Date: 20/11/2017
 * Time: 11:50 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table = 'punto';
    protected $primaryKey = 'idPunto';

    public function corredores() {
        return $this->belongsToMany('App\Corredor', 'corredor_punto', 'idPunto', 'idCorredor')
                    ->withPivot('nombreCP', 'descripcionCP', 'latitud', 'longitud');
    }
}