<?php

namespace Database\Seeders;

use App\Models\Vat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VatSeederDat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vats = array(
            [21.00,5.20,'21% Normal',1],
            [10.00,1.40,'10% Reduced',1],
            [4.00,0.50,'4% SuperReduced',1],
        );

        foreach($vats as $vat){
            Vat::firstOrCreate([
                'vat'=>$vat[0],
                'surcharge'=>$vat[1],
                'description'=>$vat[2],
            ]);
        }
    }
}
