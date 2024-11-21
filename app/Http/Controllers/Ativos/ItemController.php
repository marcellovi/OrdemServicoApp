<?php

namespace App\Http\Controllers\Ativos;

use App\Http\Controllers\Controller;
use App\Models\AtivoModelo;
use App\Models\Categoria;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function importarItensCSV(Request $request) // dont use
    {
        try{
            $file = $request->file('arquivo');
            $filePath = $file->getRealPath();
            $reader = Reader::createFromPath($filePath);

            $error = [];
            $found_error = false;
            foreach ($reader as $key => $row) {
                if(!$key == 0){

                    if(empty($row[0]) || !is_numeric($row[3]) ){
                        $error[] = "Linha ".($key+1)." nao foi importada - campo obrigatório vazio ou formato incorreto.";
                        $found_error = true;
                    }

                    if($found_error) {
                        $found_error = false;
                        continue;
                    }

                    $nome = DB::table('itens')->where('nome', $row[0])->first();
                    if(!empty($nome)){
                        $error[] = "Linha $key nao foi importada - Nome ".strtoupper($row[0])." já existe.";
                    }else{
                        Item::create([
                            'nome' => ucfirst($row[0]),
                            'modelo' => ucfirst($row[1]),
                            'descritivo' => $row[2],
                            'categoria_id' => (empty($row[3])) ? $row[3] : intval($row[3]),
                        ]);
                    }
                }
            }

        }catch(\Exception $e){
            //die($e->getMessage());
            return redirect()->route('ativos-itens')
                ->with(['message' => 'Erro ao carregar os itens. Somente .csv arquivos são aceitos!.',
                    'status' => 'Erro',
                    'type' => 'danger',
                    'errors' => $error]);
        }

        if(count($error) > 0){
            return redirect()->route('ativos-itens')
                ->with(['message' => 'Alguns Itens não forão Importado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'info',
                    'errors' => $error]);
        }
        return redirect()->route('ativos-itens')
            ->with(['message' => 'Os Itens forão Importado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function importarAtivosModelCSV(Request $request) // dont use
    {
        try{
            $file = $request->file('arquivo');
            $filePath = $file->getRealPath();
            $reader = Reader::createFromPath($filePath);

            $error = [];
            $found_error = false;
            foreach ($reader as $key => $row) {
                if(!$key == 0){

                    if(empty($row[0]) || empty($row[1]) || empty($row[5]) || !is_numeric($row[5]) ){
                        $error[] = "Linha ".($key+1)." nao foi importada - campo obrigatório vazio ou formato incorreto.";
                        $found_error = true;
                    }

                    if($found_error) {
                        $found_error = false;
                        continue;
                    }

                    $sigla = DB::table('ativo_modelo')->where('sigla', $row[0])->first();

                    // TODO - DON'T ALLOW SAVE CATEGORIA_ID THAT DON'T EXIST //

                    if(!empty($sigla)){
                        $error[] = "Linha $key nao foi importada - Sigla ".strtoupper($row[0])." já existe.";
                    }else{
                        AtivoModelo::create([
                            'sigla' => strtoupper($row[0]),
                            'nome' => ucfirst($row[1]),
                            'modelo' => intval($row[2]),
                            'serie' => $row[3],
                            'descritivo' => $row[4],
                            'categoria_id' => (empty($row[5])) ? $row[5] : intval($row[5]),
                        ]);
                    }
                }
            }

        }catch(\Exception $e){
            //die($e->getMessage());
            return redirect()->route('ativos-itens')
                ->with(['message' => 'Erro ao carregar os itens. Somente .csv arquivos são aceitos!',
                    'status' => 'Erro',
                    'type' => 'danger',
                    'errors' => $error]);
        }

        if(count($error) > 0){
            return redirect()->route('ativos-itens')
                ->with(['message' => 'Alguns Ativos não forão Importado no Sistema.',
                    'status' => 'Sucesso',
                    'type' => 'info',
                    'errors' => $error]);
        }
        return redirect()->route('ativos-itens')
            ->with(['message' => 'Os Itens forão Importado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

}
