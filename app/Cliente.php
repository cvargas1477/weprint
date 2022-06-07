<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $guarded = ['id'];

   //protected $fillable = ['id', 'rut', 'nombres','apellidos', 'celular', 'direccion', 'email', 'observacion' ];
}
