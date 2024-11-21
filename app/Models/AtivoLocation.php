<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtivoLocation extends Model
{
    protected $table = 'ativos_location';
    protected $fillable = ['nome','tipo'];
}
