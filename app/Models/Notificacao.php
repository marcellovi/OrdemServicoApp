<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';
    protected $fillable = ['message','fromUserId','toUserId','status_id','prioridade_id'];
}
