<?php

namespace Database\Seeders;

use App\SeederFunctions\SeederProcessCreator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'Customer';
        $modelNamePlural    = 'Customers';

        $menuFather         = 'Archive';
        $menuSubFather      = null;
        $menuFatherIcon     = 'side-menu__icon fa-solid fa-city';

        $modelNamespace     = 'App\Models\\'.$modelName;

        SeederProcessCreator::createSeeders(
            $roleName,
            $modelName,
            $modelNamePlural,
            $modelNamespace,
            $menuFather,
            $menuSubFather,
            $menuFatherIcon
        );
    }
}
