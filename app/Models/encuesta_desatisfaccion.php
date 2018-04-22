<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class encuesta_desatisfaccion extends Model
{
  protected $fillable = ['customer_id', 'p1','p2','p3','p4','p5','p6','p7'];
}
