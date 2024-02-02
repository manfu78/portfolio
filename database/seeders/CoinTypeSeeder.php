<?php

namespace Database\Seeders;

use App\Models\AppModel;
use App\SeederFunctions\SeederProcessCreator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CoinTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleName           = 'Administrador';
        $modelName          = 'CoinType';
        $modelNamePlural    = 'CoinTypes';

        $menuFather         = 'Admin';
        $menuSubFather      = 'Aux';
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
