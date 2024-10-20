<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionController extends Controller
{
    public function addPermission(Request $request){

        Permission::create(['name' => 'Add Product']);
    }

    /**
     * Permission to each Pages
     * @param Request $request
     * @return void
     */
    public function addPermissions(Request $request){

        $permissions = [
            'Add Product',
            'Add User'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

    /**
     * @param Request $request
     * @return
     */
    public function createRole(Request $request){

        $role = Role::create(['name' => $request->role_name]);

        foreach($request->permissions as $permission){
            $role->givePermissionTo($permission);
        }

        foreach ($request->users as $user) {
            $user = User::find($user);
            $user->assignRole($role->name);
        }

        return redirect('show-roles-permissions');
    }

    public function showRolesPermissions(Request $request){
        $roles = Role::all();
        $roles_names = [];

        $permissions = Permission::all();
        $permissions_names = [];

        //$users = User::where('id', '!=', 'model_id')->get(); dd($users);
        // All users that don't have any assign role
        $users = DB::table('users')
                    ->leftjoin('model_has_roles','users.id','=','model_has_roles.model_id')
                    ->whereNull('model_has_roles.role_id')
                    ->get();
        $users_names = [];

        foreach($roles as $role){
            //$roles_names[] = $role->name;
            array_push($roles_names, $role->name);
        }

        foreach($permissions as $permission){
            //$roles_names[] = $role->name;
            array_push($permissions_names, $permission->name);
        }
        foreach($users as $user){
            //$roles_names[] = $role->name;
            array_push($users_names, [$user->id,$user->name]);
        }

        return view('roles.show')
            ->with('roles', $roles_names)
            ->with('permissions', $permissions_names)
            ->with('users', $users_names);
    }

    public function test(Request $request){
        dd('a');
    }
}
