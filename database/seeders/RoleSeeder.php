<?php

namespace Database\Seeders;

use App\Models\AppModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Datos a rellenar
        $roleName           ='Administrador';
        $modelName          = 'Role';
        $modelNamePlural    = 'Roles';
        $modelNamespace     = 'Spatie\Permission\Models\\'.$roleName;



        $roleAdmin = Role::where('name','=',$roleName)->first();
        if(!$roleAdmin){
            $roleAdmin = Role::create(['name' => $roleName]);
        }

        $model = AppModel::where('name','=',$modelName)->first();
        if(!$model){
            $model = AppModel::create([
                'name'=>$modelName,
                'namespace'=>$modelNamespace,
            ]);
        }

        $permissions = [
            [$modelNamePlural.'.index','View  '.$modelNamePlural ],
            [$modelNamePlural.'.create','Create '.$modelName],
            [$modelNamePlural.'.edit','Edit '.$modelName],
            [$modelNamePlural.'.destroy','Destroy '.$modelName],
        ];
        foreach($permissions as $permission){
            if (!Permission::where('name','=',$permission[0])->first()) {
                Permission::create([
                    'name'          =>$permission[0],
                    'description'   =>$permission[1],
                    'app_model_id'  =>$model->id
                ])->syncRoles([$roleAdmin]);
            }
        }
    }
}
