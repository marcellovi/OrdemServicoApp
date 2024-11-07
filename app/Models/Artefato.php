<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artefato extends Model
{
    protected $fillable = [
        'sigla','nome','sub_artefato_id',
    ];
}
