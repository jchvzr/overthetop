<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usuariosDetail extends Model
{
    //
      protected $fillable = ['id', 'nombre','apellidoPaterno','apellidoMaterno','domicilioCalle','domicilioColonia','domicilioCiudad','domicilioCP','fechaNacimiento','sexo','curp','rfc','nss','fechaingreso','id_usuario'];

}
