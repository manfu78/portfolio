<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SidebarMenuSeeder extends Seeder
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
            ['sidebarMenus.index','Sidebar Menus'],
            ['sidebarMenus.create','Create Sidebar Menu'],
            ['sidebarMenus.edit','Edit Sidebar Menu'],
            ['sidebarMenus.destroy','Destroy Sidebar Menu'],
        ];

        foreach($permissions as $permission){
            if (!Permission::where('name','=',$permission[0])->first()) {
                Permission::create([
                    'name'          =>$permission[0],
                    'description'   =>$permission[1],
                ])->assignRole('Administrador');
            }
        }
    }
}
