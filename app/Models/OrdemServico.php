<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $table = 'ordem_servicos';

    protected $fillable = [
        'numero_os','tags','ativo_id','data_abertura', 'data_programada', 'prioridade_id','tipo_manutencao_id',
        'natureza_servico_id', 'equipe_responsavel_id', 'responsavel_id','mantenedor_id','auxiliar_id','status_id',
        'diagnostico','solucao','pecas_trocadas',
    ];
}