<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddUserRolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id' => 1, 'name' => 'dashboard'],            // gestao os
            ['id' => 2, 'name' => 'management'],            // gestao os
            ['id' => 3, 'name' => 'preventive'],            // gestao os
            ['id' => 4, 'name' => 'reports'],            // gestao os
            ['id' => 5, 'name' => 'assets'],            // gestao os
            ['id' => 6, 'name' => 'teams'],            // gestao os
            ['id' => 7, 'name' => 'transactions'],            // gestao os
        ];

        foreach($permissions  as $permission){
            Permission::create($permission);
        }

        DB::table('role_has_permissions')->insert(['permission_id' => 1,'role_id' => 1]);
        DB::table('role_has_permissions')->insert(['permission_id' => 2,'role_id' => 1]);
        DB::table('role_has_permissions')->insert(['permission_id' => 3,'role_id' => 1]);
        DB::table('role_has_permissions')->insert(['permission_id' => 4,'role_id' => 1]);
        DB::table('role_has_permissions')->insert(['permission_id' => 5,'role_id' => 1]);
        DB::table('role_has_permissions')->insert(['permission_id' => 6,'role_id' => 1]);
        DB::table('role_has_permissions')->insert(['permission_id' => 7,'role_id' => 1]);

        DB::table('role_has_permissions')->insert(['permission_id' => 1,'role_id' => 2]);
        DB::table('role_has_permissions')->insert(['permission_id' => 2,'role_id' => 2]);
        DB::table('role_has_permissions')->insert(['permission_id' => 3,'role_id' => 2]);
        DB::table('role_has_permissions')->insert(['permission_id' => 4,'role_id' => 2]);

        DB::table('role_has_permissions')->insert(['permission_id' => 1,'role_id' => 3]);
        DB::table('role_has_permissions')->insert(['permission_id' => 2,'role_id' => 3]);
        DB::table('role_has_permissions')->insert(['permission_id' => 3,'role_id' => 3]);

// Model Has Roles
        $roles = [1,2,3]; // Role Has Permission
        foreach ($roles as $role) {
            DB::table('model_has_roles')
                ->insert(
                    [   'role_id' => $role,
                        'model_type' => 'App\Models\User',
                        'model_id' => $role
                    ]
                );
        }


//        $role_permissions = Permission::all();
//        foreach($role_permissions as $permission){
//            //echo 'Permissao : '.$permission->id.' | ';
//            foreach($roles as $role){
//                echo "( ".$role.", ".$permission->id.") \n";
//                if( $role = 1 ){
//                    DB::table('role_has_permissions')->insert(['permission_id' => $permission->id, 'permission_id' =>  $role]);
//                }
//                if( $role = 2 && $permission->id <= 5)
//                    DB::table('role_has_permissions')->insert(['permission_id' => $permission->id, 'role_id' => $role]);
//                if( $role = 3 && $permission->id <= 3)
//                    DB::table('role_has_permissions')->insert(['permission_id' => $permission->id, 'role_id' => $role]);
//            }
//        }




    }
}
