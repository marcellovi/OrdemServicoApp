<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = ['codprod','nome','descricao','qt_minima','qt_reposicao','unid_medida_id','fabricante_id','categoria_id'];
}
