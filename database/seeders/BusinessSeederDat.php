<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeederDat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businesses = array(
            ['DEMO', 'DEMO','B00000000','000000000','demo@demo.es','Calle Demo, 5','30813','Lorca','Murcia',1,73,3],
        );

        foreach($businesses as $business){
            Business::firstOrCreate([
                'name'=>$business[0],
                'tradename'=>$business[1],
                'cif'=>$business[2],
                'phone'=>$business[3],
                'email'=>$business[4],
                'address'=>$business[5],
                'postal_code'=>$business[6],
                'city'=>$business[7],
                'province'=>$business[8],
                'default'=>$business[9],
                'country_id'=>$business[10],
                'vat_id'=>$business[11],
            ]);
        }
    }
}
