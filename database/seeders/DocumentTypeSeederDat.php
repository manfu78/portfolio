<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeederDat extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = array(
            ['Presupuesto'],
            ['Pedido'],
            ['Albarán'],
            ['Factura'],
            ['Nominas'],
            ['Otro'],
        );

        foreach($documentTypes as $documentType){
            DocumentType::firstOrCreate([
                'type'=>$documentType[0],
            ]);
        }
    }
}
