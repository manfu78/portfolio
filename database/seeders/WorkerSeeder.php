<?php

namespace Database\Seeders;

use App\SeederFunctions\SeederProcessCreator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'Worker';
        $modelNamePlural    = 'Workers';

        $menuFather         = 'Admin';
        $menuSubFather      = null;
        $menuFatherIcon     = 'side-menu__icon fe fe-layers';

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
