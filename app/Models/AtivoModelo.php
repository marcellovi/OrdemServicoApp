<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtivoModelo extends Model
{
    public $table = 'ativo_modelo';
    protected $fillable = [ 'sigla', 'nome','categoria_id','modelo','serie','descritivo',
    ];
}
