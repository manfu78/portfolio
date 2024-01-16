<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuFather extends Model
{
    use HasFactory;

    protected $with = ['sidebarMenus','sidebarMenuSubFathers'];

    protected $fillable = ['name','icon','order'];

    public function sidebarMenuItems(){
        return $this->hasMany(SidebarMenuItem::class);
    }

    public function sidebarMenuSubFathers(){
        return $this->hasMany(SidebarMenuSubFather::class);
    }

    public function routesForExpandedMenu(){
        $sidebarMenuSubFatherIds = $this->sidebarMenuSubFathers->pluck('id');
        $sidebarMenus = SidebarMenuItem::orderBy('order','asc')
            ->where('sidebar_menu_father_id','=',$this->id)
            ->orWhereIn('sidebar_menu_sub_father_id',$sidebarMenuSubFatherIds)
            ->get();

        return $sidebarMenus->toArray();

        // $routesForExpandedMenu = null;
        // foreach ($sidebarMenus as $sidebarMenu) {
        //     $routesForExpandedMenu[] = routeForActiveMenu($sidebarMenu->route);
        // }
        // return $routesForExpandedMenu;
    }

    public function permissionsForMenu(){
        $sidebarMenuSubFatherIds = $this->sidebarMenuSubFathers->pluck('id');
        $permissionsForMenu = SidebarMenuItem::orderBy('order')
            ->select('permission')
            ->where('sidebar_menu_father_id',$this->id)
            ->orWhereIn('sidebar_menu_sub_father_id',$sidebarMenuSubFatherIds)
            ->where('active','=',1)
            ->pluck('permission');
        return $permissionsForMenu;
    }
}
