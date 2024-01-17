<?php

use App\Models\AppModel;
use App\Models\SidebarMenuFather;
use App\Models\SidebarMenuItem;
use App\Models\SidebarMenuSubFather;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


function createSeeders($roleName,$modelName,$modelNamePlural,$modelNamespace,$menuFather,$menuSubFather){

    // try {
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
            ['.show','View '.$modelName],
            ['.index', $modelNamePlural],
            ['.create','Create '.$modelName],
            ['.edit','Edit '.$modelName],
            ['.destroy','Destroy '.$modelName],
        ];

        foreach($permissions as $permission){
            $permissionName = lcfirst($modelNamePlural).$permission[0];
            if (!Permission::where('name','=',$permissionName)->first()) {
                Permission::create([
                    'name'          =>$permissionName,
                    'description'   =>$permission[1],
                    'app_model_id'  =>$model->id,
                ])->assignRole('Administrador');
            }
        }




        $sidebarMenuFather = SidebarMenuFather::where('name','=',$menuFather)->first();
        $sidebarMenuSubFather = null;

        $maxOrder = SidebarMenuFather::max('order');
        $maxSubOrder = SidebarMenuSubFather::max('order');
        if(!$sidebarMenuFather){
            $sidebarMenuFather = SidebarMenuFather::create([
                'name'  =>$menuFather,
                'icon'  =>'side-menu__icon fe fe-layers',
                'order' =>++$maxOrder,
            ]);
            if ($menuSubFather) {
                $sidebarMenuSubFather = SidebarMenuSubFather::create([
                    'name'=>$menuSubFather,
                    'sidebar_menu_father_id'=>$sidebarMenuFather->id,
                    'order'=>++$maxSubOrder,
                ]);
            }
        }else{
            if ($menuSubFather) {
                $sidebarMenuSubFather = SidebarMenuSubFather::where('sidebar_menu_father_id','=',$sidebarMenuFather->id)->where('name','=',$menuSubFather)->first();
                if (!$sidebarMenuSubFather) {
                    $sidebarMenuSubFather = SidebarMenuSubFather::create([
                        'name'=>$menuSubFather,
                        'sidebar_menu_father_id'=>$sidebarMenuFather->id,
                        'order'=>++$maxSubOrder,
                    ]);
                }
            }
        }

        $sidebarMenuItemMax = SidebarMenuItem::max('order');
        $sidebarMenuItemArray = [
            'name'=>$modelNamePlural,
            'route'=>'admin.'.lcfirst($modelNamePlural).'.index',
            'permission'=>lcfirst($modelNamePlural).'.index',
            'sidebar_menu_father_id'=>$sidebarMenuFather->id,
            'sidebar_menu_sub_father_id'=>$sidebarMenuSubFather?$sidebarMenuSubFather->id:null,
            'order'=>++$sidebarMenuItemMax,
        ];

        $sidebarMenuItem = SidebarMenuItem::where('name','=',$modelNamePlural)->first();
        if (!$sidebarMenuItem) {
            SidebarMenuItem::create($sidebarMenuItemArray);
        }else{
            $sidebarMenuItem->update($sidebarMenuItemArray);
        }
    // } catch (\Throwable $th) {
            // Log::error(
            //     $th->getMessage(),array(
            //         'Message'=>$th->getMessage(),
            // ));
    //     return false;
    // }

}
