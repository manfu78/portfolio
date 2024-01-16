<?php

use App\Models\Notification;

if(!function_exists('haveNotifications')){
    function haveNotifications ():bool
    {
        try {
            $haveNotifications = Notification::where('user_id','=',auth()->user()->id)
            ->where('readed','=',0)
            ->exists();
            return $haveNotifications;
        } catch (\Throwable $th) {
            return false;
        }

    }
}

if(!function_exists('myNotifications')){
    function myNotifications ()
    {
        try {
            $myNotifications = Notification::orderBy('readed')
                ->orderBy('date')
                ->where('user_id','=',auth()->user()->id)
                ->limit(15)
                ->get();

            return $myNotifications;
        } catch (\Throwable $th) {
            return [];
        }

    }
}
