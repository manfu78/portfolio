<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class LogViewerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['log-viewer::dashboard','View Logs','Log','LogViewer'],
            ['log-viewer::logs.create','Create Log','Log','LogViewer'],
            ['log-viewer::logs.edit','Edit Log','Log','LogViewer'],
            ['log-viewer::logs.destroy','Destroy Log','Log','LogViewer'],
        ];
        foreach($permissions as $permission){
            if (!Permission::where('name','=',$permission[0])->first()) {
                Permission::create([
                    'name'          =>$permission[0],
                    'description'   =>$permission[1],
                    'model'         =>$permission[2],
                    'menu'          =>$permission[3],
                ])->assignRole('Administrador');
            }
        }
    }
}
