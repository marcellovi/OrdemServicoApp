<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'estoque';

    protected $fillable = ['produto_id','quantidade_total','estoque_local_id'];
}
