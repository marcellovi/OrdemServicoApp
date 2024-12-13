<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public static function formatIntDate($date){
        $locale = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
        if($locale == 'pt-BR'){
            $date = explode('/',$date);
            return $date[1].'/'.$date[0].'/'.$date[2];  // change dd/mm/yyyy to mm/dd/yyyy
        }else{
            return $date;
        }
    }
}
