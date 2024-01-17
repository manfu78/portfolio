<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// include 'database/seeders/Functions/SeederFunctions.php';

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'Country';
        $modelNamePlural    = 'Countries';
        $modelNamespace     = 'App\Models\\'.$modelName;

        $menuFather         = 'Admin';
        $menuSubFather      = 'Aux';


        createSeeders($roleName,$modelName,$modelNamePlural,$modelNamespace,$menuFather,$menuSubFather);
    }
}
