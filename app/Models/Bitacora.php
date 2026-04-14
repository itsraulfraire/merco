<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacora';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id','nivel','accion','estado','descripcion',
        'ruta','metodo','ip','agente_usuario','entidad','entidad_id','created_at'
    ];
}