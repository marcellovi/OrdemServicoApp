<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ativo extends Model
{
    protected $fillable = [ 'tags','ativo_modelo_id','bloco_id','fase_id','andar_id','sala_area_id','ativo',
        ];
}
