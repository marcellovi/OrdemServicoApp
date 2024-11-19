<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = 'itens';
    protected $fillable = ['nome','modelo','descritivo','categoria_id'];
}
