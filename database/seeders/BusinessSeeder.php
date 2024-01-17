<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'Business';
        $modelNamePlural    = 'Businesses';

        $menuFather         = 'Admin';
        $menuSubFather      = 'Aux';

        $modelNamespace     = 'App\Models\\'.$modelName;

        createSeeders($roleName,$modelName,$modelNamePlural,$modelNamespace,$menuFather,$menuSubFather);
    }
}
