<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminData = [
            'name'=>'SuperAdmin',
            'email'=>'germansoy@gmail.com',
            'password'=>bcrypt('PicaPica23'),
        ];

        $superAdmin = User::where('email','=',$superAdminData['email'])->first();
        if (!$superAdmin) {
            $superAdmin = User::create($superAdminData);
            $superAdmin->assignRole('Administrador');
        }

        // $user = User::create([
        //     'name'=>'admin',
        //     'password'=>bcrypt('kordino2023crm')
        // ]);
        // $user->assignRole('Administrador');
    }
}
