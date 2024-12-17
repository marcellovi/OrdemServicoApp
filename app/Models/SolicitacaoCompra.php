<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoCompra extends Model
{
    protected $table = 'solicitacao_compra';

    protected $fillable = ['codigo_solicitacao_compra','status_id','prioridade_id','solicitacao','resposta','responsavel_id',
        'assinatura','data_solicitacao'];
}
