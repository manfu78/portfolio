<?php

namespace Database\Seeders;

use App\SeederFunctions\SeederProcessCreator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'DocumentType';
        $modelNamePlural    = 'DocumentTypes';

        $menuFather         = 'DocumentManagement';
        $menuSubFather      = 'Aux';
        $menuFatherIcon     = 'side-menu__icon fa-regular fa-folder';

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
