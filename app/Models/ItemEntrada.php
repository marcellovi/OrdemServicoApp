<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemEntrada extends Model
{
    protected $table = 'item_entrada';

    protected $fillable = ['solicitacao_compra_id','produto_id','quantidade','entrada_id','lote','valor'];
}
