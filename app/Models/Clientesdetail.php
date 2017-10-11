<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientesdetail extends Model
{
    protected $fillable = ['customerid','nombreCliente','calleCasa','coloniaCasa','ciudadCasa','cpCasa','calleTrabajo','coloniaTrabajo','ciudadTrabajo','cpTrabajo','telefono1','telefono2','telefono3','telefono4','custom1','custom2','custom3','custom4','custom5','custom6','custom7','custom8','custom9','custom10'];
}
