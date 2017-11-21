<?php
/**
 * Created by PhpStorm.
 * User: JONATHAN.CASTRO
 * Date: 20/11/2017
 * Time: 8:34 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
}