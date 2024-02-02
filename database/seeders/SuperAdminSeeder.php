<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName ='Administrador';

        $role = Role::where('name','=',$roleName)->first();
        if(!$role){
            $role = Role::create(['name' => $roleName]);
        }

        $superAdminData = [
            'name'=>'SuperAdmin',
            'email'=>'admin@germanraulgarcia.es',
            'password'=>bcrypt('PicaPica23'),
        ];


        $superAdmin = User::firstOrCreate($superAdminData);
        $superAdmin->assignRole($role->name);



        // $user = User::create([
        //     'name'=>'admin',
        //     'password'=>bcrypt('kordino2023crm')
        // ]);
        // $user->assignRole('Administrador');
    }
}
