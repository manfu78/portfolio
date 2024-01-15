<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['users.index','View Users','User','Users'],
            ['users.create','Create User','User','Users'],
            ['users.edit','Edit User','User','Users'],
            ['users.destroy','Destroy User','User','Users'],
        ];


        foreach($permissions as $permission){
            if (!Permission::where('name','=',$permission[0])->first()) {
                Permission::create([
                    'name'          =>$permission[0],
                    'description'   =>$permission[1],
                    'model'         =>$permission[2],
                    'menu'          =>$permission[3],
                ])->assignRole('Administrador');
            }
        }
    }
}
