<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        //$date = date('Ymdhms');
        $data = [
            'cargos' => DB::table('cargos')->where('deleted_at', '=', null)->get(),
            'equipes' => DB::table('equipes')->where('deleted_at', '=', null)->get(),
            'roles' => DB::table('roles')->get(), //->where('deleted_at', '=', null)->get(),
            'status' => DB::table('status')->where('tipo_status','rh')->get(),
        ];

        $usuarios = DB::table('users')
            ->select('name','email','matricula','users.id as user_id','model_has_roles.role_id as role_id',
                'cargo_id','equipe_id','status_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
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
            'status' => DB::table('status')->where('tipo_status','rh')->get(),
        ];

        $usuario = DB::table('users')
            ->select('email','users.name as nome_usuario','users.id as user_id','model_has_roles.role_id as role_id',
                'cargo_id','equipe_id','matricula','status_id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->where('users.id', '=', $id)
            ->first();

        return view('usuarios.edit',compact('usuario','data'));
    }

    public function store(Request $request)
    {
        try{

            $is_found = User::where('email', $request['email'])->orwhere('matricula',$request['matricula'])->first();

            if($is_found){
                return redirect()->route('usuarios')
                    ->with(['message' => 'Email '.$request['email'].' já existe no Sistema.',
                        'status' => 'Erro',
                        'type' => 'info']);
            }

            $new_user = User::create([
                'matricula' => $request['matricula'],
                'name' => $request['nome'],
                'email' => $request['email'],
                'status_id' => $request['status'],
                'cargo_id' => $request['cargo'],
                'equipe_id' => $request['equipe'],
                'password' => bcrypt($request['senha']),
            ]);

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

        DB::table('users')->where('id',$id)->update(['equipe_id' => $request->get('equipe'),
            'cargo_id' => $request->get('cargo'),
            'status_id' => $request->get('status'),
            'cargo_id' => $request->get('cargo'),
            'updated_at' => date('Y-m-d H:i:s')]);

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

    /** PERFIL **/

    public function indexPerfil($id)
    {
        $usuario = DB::table('users')
            ->select('users.id as id','users.name','email','status.nome as status_nome','equipes.nome as equipe_nome',
                'cargos.nome as cargo_nome','roles.name as role_nome','avatar')
            ->leftJoin('cargos', 'users.cargo_id', '=', 'cargos.id')
            ->leftJoin('equipes', 'users.equipe_id', '=', 'equipes.id')
            ->leftJoin('status','users.status_id','=','status.id')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', $id)->first();
        return view('perfil.index', compact('usuario'));
    }

    public function updatePerfil(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->update($request->all());

        return redirect()->route('perfil.index',$id)
            ->with(['message' => 'Informações Atualizadas no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }

    public function updateAvatar(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $avatar = null;
        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){

            // Two ways to upload a file
            //$avatar = $request->file('avatar')->store(options:'public');
            // $avatar = Storage::disk('public')->put('avatars', $request->file('avatar'));

//            if(!empty($user->avatar)){
//                if(file_exists(public_path('assets/avatars/'.$user->avatar))){
//                    unlink(public_path('assets/avatars/'.$user->avatar));
//                }
//                if(Storage::disk('public')->exists($user->avatar)  ){
//                    Storage::disk('public')->delete($user->avatar);
//                }
//            }
            //$avatar = Storage::disk('public')->put('avatars', $request->file('avatar'));
            $avatar = $request->file('avatar')->store(options:'avatar');
        }


        if(!empty($user->avatar)){
            if(file_exists(public_path('assets/avatars/'.$user->avatar))){
                unlink(public_path('assets/avatars/'.$user->avatar));
            }
//                if(Storage::disk('public')->exists($user->avatar)  ){
//                    Storage::disk('public')->delete($user->avatar);
//                }
        }
        $user->avatar = $avatar;
        $user->save();

        return redirect()->route('perfil.index', $request->id)
            ->with(['message' => 'Avatar Atualizado no Sistema.',
                'status' => 'Sucesso',
                'type' => 'success']);
    }
}
