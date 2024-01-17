<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'Category';
        $modelNamePlural    = 'Categories';

        $menuFather         = 'Admin';
        $menuSubFather      = 'Aux';

        $modelNamespace     = 'App\Models\\'.$modelName;

        createSeeders($roleName,$modelName,$modelNamePlural,$modelNamespace,$menuFather,$menuSubFather);
    }
}
