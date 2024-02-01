<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class SidebarMenuFather extends Model
{
    use HasFactory;

    protected $with = ['sidebarMenuItems','sidebarMenuSubFathers'];
    protected $fillable = ['name','icon','order','active'];

    public function sidebarMenuItems():HasMany
    {
        return $this->hasMany(SidebarMenuItem::class);
    }

    public function sidebarMenuActiveItems():HasMany
    {
        return $this->sidebarMenuItems->whereNull('sidebar_menu_sub_father_id')->where('active');
    }

    public function sidebarMenuSubFathers():HasMany
    {
        return $this->hasMany(SidebarMenuSubFather::class);
    }

    public function routesForExpandedMenu():array
    {
        $sidebarMenuSubFatherIds = $this->sidebarMenuSubFathers->pluck('id');
        $activeSidebarMenus = SidebarMenuItem::where('active','=',1)
            ->where('sidebar_menu_father_id','=',$this->id)
            ->orWhereIn('sidebar_menu_sub_father_id',$sidebarMenuSubFatherIds)
            ->get();

        $routesForExpandedMenu = null;
        foreach ($activeSidebarMenus as $activeSidebarMenu) {
            $routesForExpandedMenu[] = routeForActiveMenu($activeSidebarMenu->route);
        }
        return $routesForExpandedMenu;
    }

    public function permissionsForMenu():Collection
    {
        $sidebarMenuSubFatherIds = $this->sidebarMenuSubFathers->pluck('id');
        $permissionsForMenu = SidebarMenuItem::orderBy('permission')
            ->select('permission')
            ->where('sidebar_menu_father_id',$this->id)
            ->orWhereIn('sidebar_menu_sub_father_id',$sidebarMenuSubFatherIds)
            ->where('active','=',1)
            ->pluck('permission');
        return $permissionsForMenu;
    }
}
