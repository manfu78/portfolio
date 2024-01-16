<?php

use App\Models\SidebarMenuFather;
use App\Models\UserConfig;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\DB;


// userHome() sidebar_menu_start_id
if(!function_exists('userHome')){
    function userHome (){
        if ($userHome = UserConfig::where('user_id',auth()->user()->id)->first()) {
            return $userHome->sidebarMenuStart;
        }
        return null;
    }
}
