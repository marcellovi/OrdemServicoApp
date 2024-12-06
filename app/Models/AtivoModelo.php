<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class AtivoModelo extends Model
{
    public $table = 'ativo_modelo';
    protected $fillable = [ 'sigla', 'nome','categoria_id','modelo','serie','descritivo',
    ];

    public static function uploadDocumentos(Array $arquivos){

        $file_names = [];
        foreach($arquivos as $arquivo){
            $file_names[] = $arquivo->store(options:'doc_ativos');
        }
        return $file_names;
    }
}
