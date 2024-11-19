<?php

namespace App\Http\Controllers\Ativos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // dont use
    {
        $categorias = Categoria::all()->where('deleted_at', '=', null);
        $items = Item::all();

        return view('ativos.ativos_item.index', compact('items','categorias'));
    }
    public function importarItens(Request $request) // dont use
    {
        $itens = Item::all();


        try{

//            $check = getimagesize($_FILES["arquivo"]["tmp_name"]);
//            if($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
//                $uploadOk = 1;
//            } else {
//                echo "File is not an image.";
//                $uploadOk = 0;
//            } dd('stop');

//dd($_FILES["arquivo"]['full_path']);

            $itens = (new FastExcel)->import($_FILES["arquivo"]['full_path'], function ($line) {
                return Item::create([
                    'nome' => $line['nome'],
                    'modelo' => $line['modelo'],
                    'descritivo' => $line['descritivo'],
                    'categoria_id' => $line['categoria']
                ]);
            });


        }catch(\Exception $e){
            dd($e->getMessage());
        }


        dd($request->all());
        $categorias = Categoria::all()->where('deleted_at', '=', null);
        $items = Item::all();

        return view('ativos.ativos_item.index', compact('items','categorias'));
    }


}
