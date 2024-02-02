<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuSubFather extends Model
{
    use HasFactory;

    protected $with = ['sidebarMenuItems'];

    protected $fillable = ['name', 'active', 'order','sidebar_menu_father_id'];

    public function sidebarMenuItems(){
        return $this->hasMany(SidebarMenuItem::class);
    }

    public function sidebarMenuFather(){
        return $this->belongsTo(SidebarMenuFather::class);
    }

    public function routesForExpandedMenu(){
        $sidebarMenuItems = $this->sidebarMenuItems;

        if ($sidebarMenuItems) {
           return $sidebarMenuItems->pluck('route')->toArray();
        }
        return [];
    }

    public function permissionsForMenu(){
        $sidebarMenuItems = $this->sidebarMenuItems;
        $permissionsForMenu = $sidebarMenuItems->sortBy('order')->pluck('permission');

        return $permissionsForMenu;
    }
}
