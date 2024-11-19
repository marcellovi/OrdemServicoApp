<?php

namespace App\Http\Controllers\Ativos;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Http\Request;
use League\Csv\Reader;
use Rap2hpoutre\FastExcel\FastExcel;
use Spatie\SimpleExcel\SimpleExcelReader;

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
        try{

            $file = $request->file('arquivo');
            $filePath = $file->getRealPath();
            $reader = Reader::createFromPath($filePath);

            foreach ($reader as $key => $row) {

                if(!$key == 0){
                    Item::create([
                        'nome' => ucfirst($row[0]),
                        'modelo' => ucfirst($row[1]),
                        'categoria_id' => intval($row[2]),
                        'descritivo' => $row[3],
                    ]);
                }
            }

        }catch(\Exception $e){
            die($e->getMessage());
        }
        return redirect()->route('ativos-itens')
            ->with(['message' => 'Os Itens forão Importado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

}
