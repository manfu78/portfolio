<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName ='Administrador';

        $roleAdmin = Role::where('name','=',$roleName)->first();
        if(!$roleAdmin){
            $roleAdmin = Role::create(['name' => $roleName]);
        }

        $permissions = [
            ['roles.index','View Roles','Role','Roles'],
            ['roles.create','Create Role','Role','Roles'],
            ['roles.edit','Edit Role','Role','Roles'],
            ['roles.destroy','Destroy Role','Role','Roles'],
        ];
        foreach($permissions as $permission){
            if (!Permission::where('name','=',$permission[0])->first()) {
                Permission::create([
                    'name'          =>$permission[0],
                    'description'   =>$permission[1],
                    'model'         =>$permission[2],
                    'menu'          =>$permission[3],
                ])->syncRoles([$roleAdmin]);
            }
        }
    }
}
