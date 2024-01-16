<?php

// routeables()

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

if(!function_exists('routeables')){
    function routeables (){
        $routes = [
            'App\Models\Opportunity'=>'admin.opportunities.show',
            'App\Models\Worker'=>'admin.workers.edit',
            'App\Models\Project'=>'admin.projects.show',
            'App\Models\ProjectChore'=>'admin.projects.show',
            'App\Models\Customer'=>'admin.customers.edit',
            'App\Models\Business'=>'admin.businesses.edit',
            'App\Models\Expense'=>'admin.expenses.edit',
        ];
        return $routes;
    }
}

// routeForActiveMenu()
if(!function_exists('routeForActiveMenu')){
    function routeForActiveMenu ($route){
        $routeForActiveMenuArray = explode(".", $route);
        $routeForActiveMenu = $routeForActiveMenuArray[0].'.'.$routeForActiveMenuArray[1].'.*';
        return $routeForActiveMenu;
    }
}

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
