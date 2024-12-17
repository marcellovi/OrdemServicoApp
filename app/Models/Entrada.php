<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entrada';
    protected $fillable = ['num_nf','imposto','frete','total','data_entrada','responsavel_id','nota_fiscal_doc'];
}
