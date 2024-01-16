<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuSubFather extends Model
{
    use HasFactory;

    protected $with = ['sidebarMenus'];

    protected $fillable = ['name', 'order','sidebar_menu_father_id'];

    public function sidebarMenuItems(){
        return $this->hasMany(SidebarMenuItem::class);
    }

    public function sidebarMenuFather(){
        return $this->belongsTo(SidebarMenuFather::class);
    }

    public function routesForExpandedMenu(){
        $sidebarMenus = $this->sidebarMenus;
        return $sidebarMenus->pluck('route')->toArray();


        // $routesForExpandedMenu = null;
        // foreach ($sidebarMenus as $sidebarMenu) {
        //     $routesForExpandedMenu[] = routeForActiveMenu($sidebarMenu->route);
        // }
        // return $routesForExpandedMenu;
    }

    public function permissionsForMenu(){
        $sidebarMenus = $this->sidebarMenus;
        $permissionsForMenu = $sidebarMenus->orderBy('order')->pluck('permission');

        return $permissionsForMenu;
    }

}
