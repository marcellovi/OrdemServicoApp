<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function store(Request $request){

        // check if cargo exist
        $is_found = Cargo::where('nome',$request['nome'])->first();
        if($is_found){
            return redirect()->route('usuarios')
                ->with(['message' => 'Cargo '.$request->get('nome').' já existe no Sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }
        Cargo::create([
            'nome' => $request['nome'],
        ]);

        return redirect()->route('usuarios')
            ->with(['message' => 'Cargo '.$request->get('nome').' foi Cadastrado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
