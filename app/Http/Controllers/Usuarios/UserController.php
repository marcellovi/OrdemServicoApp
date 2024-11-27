<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        //$date = date('Ymdhms');
        $data = [
            'cargos' => DB::table('cargos')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'roles' => DB::table('roles')->get(), //->where('deleted_at', '=', null)->get(),
        ];

        $usuarios = DB::table('users')
            ->select('name','email','matricula','users.id as user_id','model_has_roles.role_id as role_id',
                'user_equipes.cargo_id','user_equipes.equipe_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftjoin('user_equipes', 'user_equipes.user_id', '=', 'users.id')
            //->where('users.deleted_at', '=', null)
            ->get();

        return view('usuarios.index', compact('usuarios','data'));
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'cargos' => DB::table('cargos')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'roles' => DB::table('roles')->get(), //->where('deleted_at', '=', null)->get(),
        ];

        $usuario = DB::table('users')
            ->select('email','users.name as nome_usuario','users.id as user_id','model_has_roles.role_id as role_id',
                'user_equipes.cargo_id','user_equipes.equipe_id','matricula')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftjoin('user_equipes', 'user_equipes.user_id', '=', 'users.id')
            ->where('users.id', '=', $id)
            ->first();

        return view('usuarios.edit',compact('usuario','data'));
    }

    public function store(Request $request)
    {
        try{

            $is_found = User::where('email', $request['email'])->first();
            if($is_found){

                return redirect()->route('usuarios')
                    ->with(['message' => 'Email '.$request['email'].' já existe no Sistema.',
                        'status' => 'Erro',
                        'type' => 'info']);
            }

            $new_user = User::create([
                'matricula' => intval(date("YmdhHis")),
                'name' => $request['nome'],
                'email' => $request['email'],
                'password' => bcrypt($request['senha']),
            ]);

            DB::table('user_equipes')->insert([ 'user_id' => $new_user->id,'equipe_id' => $request['equipe'],'cargo_id' => $request['cargo']]);

        }catch (\Exception $exception){
dd($exception);
            return redirect()->route('usuarios')
                ->with(['message' => 'Algo errado aconteceu! Não foi possivel realizar o cadastro no Sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }

        return redirect()->route('usuarios')
            ->with(['message' => 'Usuário Email. '.$request->get('email').' foi Cadastrado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function update(Request $request, $id)
    {
//        $request->validate([
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);

        if(!empty($request['role'])){
            $user_permission = DB::table('model_has_roles')->where('model_id', $id)->first();
            if(empty($user_permission)){
                DB::table('model_has_roles')
                    ->insert(
                        [   'role_id' => $request->get('role'),
                            'model_type' => 'App\Models\User',
                            'model_id' => $id
                        ]
                    );
            }else{
                DB::table('model_has_roles')
                    ->where('model_id', $id)
                    ->update(
                        [   'role_id' => $request->get('role'),
                            'model_type' => 'App\Models\User',
                            'model_id' => $id
                        ]
                    );
            }
        }else{
            DB::table('model_has_roles')->where('model_id', $id)->delete();
        }

        $user_equipes = DB::table('user_equipes')->where('user_id', '=', $id)->first();
        if(empty($user_equipes)){ // Cadastrar
            DB::table('user_equipes')->insert(['user_id' => $id,'equipe_id' => $request->get('equipe'), 'cargo_id' => $request->get('cargo'), 'created_at' => date('Y-m-d H:i:s')]);
        }else{ // Update
            DB::table('user_equipes')->where('user_id',$id)->update(['equipe_id' => $request->get('equipe'), 'cargo_id' => $request->get('cargo'), 'updated_at' => date('Y-m-d H:i:s')]);
        }



        return redirect()->route('usuarios')
            ->with(['message' => 'Usuário/Email. '.$request->get('email').' foi Atualizado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }


    public function destroy($id){

        $usuario = User::find($id);

        if(empty($usuario)){
            return redirect()->route('usuarios')
                ->with(['message' => 'Ocorreu algum erro! Usuario não existe no sistema.',
                    'status' => 'Erro',
                    'type' => 'danger']);
        }
        $matricula  = $usuario->matricula;
        $usuario->delete();

        return redirect()->route('usuarios')
            ->with(['message' => 'O Usuário matricula '.$matricula .' foi Excluido do Sistema.',
                'status' => 'Deletado',
                'type' => 'info']);
    }
}
