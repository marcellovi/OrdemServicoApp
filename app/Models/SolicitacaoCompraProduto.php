<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoCompraProduto extends Model
{
    protected $table = 'solicitacao_compra_produtos';

    protected $fillable = ['solicitacao_compra_id','produto_id','quantidade'];
}
