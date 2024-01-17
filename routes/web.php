<?php

use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SidebarMenuController;
use App\Http\Controllers\Admin\UserConfigurationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VatController;
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



Route::name('admin.')->middleware(['auth'])->group(function() {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleController::class)->except(['show']);

    Route::resource('countries', CountryController::class)->except(['show']);
    // Route::resource('vats', VatController::class);

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('bankAccounts', BankAccountController::class)->except(['show']);
    Route::resource('vats', VatController::class)->except(['show']);
    Route::resource('paymentMethods', PaymentMethodController::class)->except(['show']);


    Route::resource('businesses', BusinessController::class)->except(['show']);
        Route::controller(BusinessController::class)->group(function () {
            Route::get('businesses/{business}/deleteLogo', 'deleteLogo')->name('businesses.deleteLogo');
            Route::put('businesses/{business}/addBankAccount/{bankAccount}', 'addBankAccount')->name('businesses.addBankAccount');
            Route::put('businesses.delBankAccount/{business}', 'delBankAccount')->name('businesses.delBankAccount');
            Route::get('businesses/{business}/editDocuments', 'editDocuments')->name('businesses.editDocuments');
            Route::post('businesses.addDocument/{business}', 'addDocument')->name('businesses.addDocument');
            Route::delete('businesses.deleteDocument/{document}', 'deleteDocument')->name('businesses.deleteDocument');
        });

    Route::resource('users', UserController::class)->except(['show']);
    Route::controller(UserController::class)->group(function () {
        Route::get('users/{user}/unsetUserProfile', 'unsetUserProfile')->name('users.unsetUserProfile');
        Route::get('users/{user}/setUserProfile/{userProfile}', 'setUserProfile')->name('users.setUserProfile');
    });

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile.documents', [ProfileController::class, 'documents'])->name('profile.documents');

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


