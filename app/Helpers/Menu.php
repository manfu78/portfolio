<?php

use App\Models\SidebarMenuFather;
use App\Models\UserConfig;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\DB;

// sidebarMenuFather()
if(!function_exists('sidebarMenuFathers')){
    function sidebarMenuFathers (){
        try {
            $sidebarMenuFathers = SidebarMenuFather::orderBy('order')
                //->where('active','=',1)
                ->with('sidebarMenuItems')
                ->with('sidebarMenuSubFathers')
                ->get();
            return $sidebarMenuFathers;
        } catch (\Throwable $th) {
            return [];
        }
    }
}

// sidebarMenuFather()
if(!function_exists('sidebarMenuFavorites')){
    function sidebarMenuFavorites (){
        try {
            $sidebarMenuFavorites = DB::table('user_favorites')
                ->leftJoin('sidebar_menu_items', 'sidebar_menu_items.id', '=', 'user_favorites.sidebar_menu_item_id')
                ->select('sidebar_menu_items.*')
                ->orderBy('sidebar_menu_items.name')
                ->get();
            return $sidebarMenuFavorites;
        } catch (\Throwable $th) {
            return [];
        }
    }
}


