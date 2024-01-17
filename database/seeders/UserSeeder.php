<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos a rellenar
        $roleName           ='Administrador';
        $modelName          = 'User';
        $modelNamePlural    = 'Users';
        $modelNamespace = 'App\Models\\'.$modelName;

        $menuFather         = 'Admin';
        $menuSubFather      = null;


        createSeeders($roleName,$modelName,$modelNamePlural,$modelNamespace,$menuFather,$menuSubFather);
    }
}
