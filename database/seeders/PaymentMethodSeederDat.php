<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeederDat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vats = array(
            ['Contado',null],
            ['30 Días',30],
            ['60 Días',60],
            ['90 Días',90],
            ['120 Días',120],
            ['Giro a la vista',1],
            ['Transferencia',null],
            ['Tarjeta',null],
        );

        foreach($vats as $vat){
            PaymentMethod::firstOrCreate([
                'name'=>$vat[0],
                'postponement_days'=>$vat[1],
                'user_id_mod'=>null,
            ]);
        }
    }
}
