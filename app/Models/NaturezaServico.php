<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaturezaServico extends Model
{
    protected $table = 'natureza_servicos';
    protected $fillable = ['nome'];
}
