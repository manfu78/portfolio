<?php

// routeables()

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


//Comprobar rutas
if(!function_exists('routeExists')){
    function routeExists ($route){
        $routeExists = false;
        if (Route::has($route)) {
            return true;
        }

        Log::error(
            'RouteError',
            array(
                'Message'=>'RouteError',
                'Route'=>$route,
            ));
        return $routeExists;
    }
}
