<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\admin\SidebarMenuController;
use App\Http\Controllers\Admin\UserConfigurationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/set_language/{lang}', [Controller::class, 'set_language'])->name('set_language');

Auth::routes();

Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::name('admin.')->middleware(['auth'])->group(function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    Route::controller(UserConfigurationController::class)->group(function () {
        Route::get('userConfigurations.favorites', 'favorites')->name('userConfigurations.favorites');
        Route::get('userConfigurations/favoriteAdd/{sidebarMenu}', 'favoriteAdd')->name('userConfigurations.favoriteAdd');
        Route::DELETE('userConfigurations.favoriteDestroy/{id}', 'favoriteDestroy')->name('userConfigurations.favoriteDestroy');
        Route::get('userConfigurations.homepage', 'homepage')->name('userConfigurations.homepage');
        Route::get('userConfigurations/homeSet/{sidebarMenu}', 'homeSet')->name('userConfigurations.homeSet');
        Route::get('userConfigurations/homeUnset', 'homeUnset')->name('userConfigurations.homeUnset');
    });

    // Route::resource('sidebarMenus', SidebarMenuController::class)->except(['create','show','edit','store','destroy','update']);
    Route::controller(SidebarMenuController::class)->group(function () {
        Route::get('sidebarMenus', 'index')->name('sidebarMenus');
        Route::post('sidebarMenus/newMenuItem', 'newMenuItem')->name('sidebarMenus.newMenuItem');
        Route::post('sidebarMenus/newMenuFather', 'newMenuFather')->name('sidebarMenus.newMenuFather');
        Route::post('sidebarMenus/newMenuSubFather', 'newMenuSubFather')->name('sidebarMenus.newMenuSubFather');
        Route::put('sidebarMenus.updateItem/{sidebarMenu}', 'updateItem')->name('sidebarMenus.updateItem');
        Route::put('sidebarMenus.updateMenuFather/{sidebarMenuFather}', 'updateMenuFather')->name('sidebarMenus.updateMenuFather');
        Route::put('sidebarMenus.updateMenuSubFather/{sidebarMenuSubFather}', 'updateMenuSubFather')->name('sidebarMenus.updateMenuSubFather');
        Route::DELETE('sidebarMenus.destroyItem/{sidebarMenu}', 'destroyItem')->name('sidebarMenus.destroyItem');
        Route::DELETE('sidebarMenus.destroyMenuFather/{sidebarMenuFather}', 'destroyMenuFather')->name('sidebarMenus.destroyMenuFather');
        Route::DELETE('sidebarMenus.destroyMenuSubFather/{sidebarMenuSubFather}', 'destroyMenuSubFather')->name('sidebarMenus.destroyMenuSubFather');
    });

});


