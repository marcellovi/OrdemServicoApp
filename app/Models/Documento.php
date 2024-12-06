<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public $table = 'documentos';
    protected $fillable = [ 'nome', 'path'];

    public static function uploadDocumentos(Array $arquivos,String $filesystem){

        // Filesystem { 'doc_ativos' , 'doc_os' }

        $file_path_name = null;
        foreach($arquivos as $arquivo){
            $file_path_name[$arquivo->store(options: $filesystem )] = $arquivo->getClientOriginalName();
        }
        return $file_path_name;
    }

    public static function removeOSDocumentos(Array $arquivos){

        foreach($arquivos as $files){
            if(file_exists(public_path('assets/documentos/ordemservicos/'.$files->path))){
                unlink(public_path('assets/documentos/ordemservicos/'.$files->path));
            }
        }
    }


}
