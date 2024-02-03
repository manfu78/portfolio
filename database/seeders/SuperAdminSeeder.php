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
            'email'=>'admin@germanraulgarcia.es',
            'name'=>'SuperAdmin',
            'password'=>bcrypt('PicaPica23'),
        ];

        $userDemoData = [
            'email'=>'demo@gmail.com',
            'name'=>'DEMO',
            'password'=>bcrypt('123456789'),
        ];

        $superAdmin = User::where('email', 'admin@germanraulgarcia.es')->first();
        if (!$superAdmin) {
            $superAdmin = User::firstOrCreate($superAdminData);
        }
        $superAdmin->assignRole($role->name);

        $userDemo = User::where('email', 'demo@gmail.com')->first();
        if (!$userDemo) {
            $userDemo = User::firstOrCreate($userDemoData);
        }
        $userDemo->assignRole($role->name);

        // $user = User::create([
        //     'name'=>'admin',
        //     'password'=>bcrypt('kordino2023crm')
        // ]);
        // $user->assignRole('Administrador');
    }
}
