<?php

namespace Database\Seeders;

use App\SeederFunctions\SeederProcessCreator;
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

        SeederProcessCreator::createSeeders(
            $roleName,
            $modelName,
            $modelNamePlural,
            $modelNamespace,
            $menuFather,
            $menuSubFather
        );
    }
}
