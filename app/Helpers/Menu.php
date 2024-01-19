<?php

use App\Models\SidebarMenuFather;
use App\Models\UserConfig;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\DB;

// sidebarMenuFather()
if(!function_exists('sidebarMenuFathers')){
    function sidebarMenuFathers (){
        try {
            $sidebarMenuFathers = SidebarMenuFather::orderBy('order')->get();
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
                ->leftJoin('sidebar_menus', 'sidebar_menus.id', '=', 'user_favorites.sidebar_menu_id')
                ->select('sidebar_menus.*')
                ->orderBy('sidebar_menus.name')
                ->get();
            return $sidebarMenuFavorites;
        } catch (\Throwable $th) {
            return [];
        }
    }
}

// menuActiveForRoute()
if(!function_exists('menuActiveForRoute')){
    function menuActiveForRoute ($route){

        $routeArray = explode('.', $route);
        $menuActiveForRoute = implode('.', array_slice($routeArray, 0, 2));
        return $menuActiveForRoute;
    }
}

