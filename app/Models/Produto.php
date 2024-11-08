<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'codprod','nome','valor_unitario','valor_total','tributo','quantidade','nota_fiscal',
    ];
}
