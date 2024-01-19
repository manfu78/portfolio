<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuFather extends Model
{
    use HasFactory;

    protected $with = ['sidebarMenuItems','sidebarMenuSubFathers'];

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

        if ($sidebarMenus) {
            foreach ($sidebarMenus as $sidebarMenu) {
                $sidebarMenu->route = str_replace('index','',$sidebarMenu->route).'*';
            }
            return $sidebarMenus->pluck('route')->toArray();
        }
        return [];
    }

    public function permissionsForMenu(){
        $sidebarMenuSubFatherIds = $this->sidebarMenuSubFathers->pluck('id');
        $permissionsForMenu = SidebarMenuItem::orderBy('order')
            ->select('permission')
            ->where('sidebar_menu_father_id',$this->id)
            ->orWhereIn('sidebar_menu_sub_father_id',$sidebarMenuSubFatherIds)
            ->pluck('permission');
        return $permissionsForMenu;
    }
}
