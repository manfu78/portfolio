<?php

namespace Database\Seeders;

use App\Models\CoinType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoinTypeSeederDat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coinTypes = array(
            ['Euro','EUR','€','&euro;',1.00,1],
            ['Dollar','USD','$','&dollar;',0.97,0],
        );

        foreach($coinTypes as $coinType){
            CoinType::firstOrCreate([
                'name'=>$coinType[0],
                'code'=>$coinType[1],
                'sign'=>$coinType[2],
                'sign_html'=>$coinType[3],
                'equivalence'=>$coinType[4],
                'default'=>$coinType[5],
            ]);
        }
    }
}
