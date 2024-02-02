<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CategorySeederDat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::firstOrCreate([
            'name'=>'GENERAL',
            'hour_price'=>0,
            'unit_price'=>0,
            'details'=>null,
            'user_id_mod'=>null,
        ]);
    }
}
