<?php

namespace Database\Seeders;

use App\SeederFunctions\SeederProcessCreator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// include 'database/seeders/Functions/SeederFunctions.php';

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           ='Administrador';
        $modelName          = 'Role';
        $modelNamePlural    = 'Roles';
        $modelNamespace     = 'Spatie\Permission\Models\\'.$modelName;

        $menuFather         = 'Admin';
        $menuSubFather      = null;


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
