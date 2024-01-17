<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleName           = 'Administrador';
        $modelName          = 'PaymentMethod';
        $modelNamePlural    = 'PaymentMethods';

        $menuFather         = 'Admin';
        $menuSubFather      = 'Aux';

        $modelNamespace     = 'App\Models\\'.$modelName;

        createSeeders($roleName,$modelName,$modelNamePlural,$modelNamespace,$menuFather,$menuSubFather);
    }
}
