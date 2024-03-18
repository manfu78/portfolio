<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BankAccountController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoinTypeController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\MyNotificationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SidebarMenuController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserConfigurationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VatController;
use App\Http\Controllers\Admin\WorkerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;
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

Auth::routes(["register" => false,"reset"=>false]);



Route::name('admin.')->middleware(['auth'])->group(function() {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleController::class)->except(['show']);

    Route::resource('countries', CountryController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('coinTypes', CoinTypeController::class)->except(['show']);
    Route::resource('bankAccounts', BankAccountController::class)->except(['show']);
    Route::resource('vats', VatController::class)->except(['show']);
    Route::resource('paymentMethods', PaymentMethodController::class)->except(['show']);

    Route::resource('businesses', BusinessController::class);
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
        Route::get('users/{user}/unsetWorker', 'unsetWorker')->name('users.unsetWorker');
        Route::get('users/{user}/setWorker/{worker}', 'setWorker')->name('users.setWorker');
    });


    Route::resource('areas', AreaController::class)->except(['show']);
    Route::resource('departments', DepartmentController::class)->except(['show']);

    Route::resource('workers', WorkerController::class)->except(['show']);
    Route::controller(WorkerController::class)->group(function () {
        Route::get('workers/{worker}/unsetUser', 'unsetUser')->name('workers.unsetUser');
        Route::get('workers/{worker}/setUser/{user}', 'setUser')->name('workers.setUser');
        Route::post('workers.addDocument/{worker}', 'addDocument')->name('workers.addDocument');
        Route::delete('workers.deleteDocument/{document}', 'deleteDocument')->name('workers.deleteDocument');
        Route::get('workers/{worker}/removePhoto', 'removePhoto')->name('workers.removePhoto');
        Route::get('workers/{worker}/editDocuments', 'editDocuments')->name('workers.editDocuments');
    });

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile.documents', [ProfileController::class, 'documents'])->name('profile.documents');

    Route::controller(UserConfigurationController::class)->group(function () {
        Route::get('userConfigurations.favorites', 'favorites')->name('userConfigurations.favorites');
        Route::post('userConfigurations.favoriteAdd/{sidebarMenuItem}', 'favoriteAdd')->name('userConfigurations.favoriteAdd');
        Route::DELETE('userConfigurations.favoriteDestroy/{userFavorite}', 'favoriteDestroy')->name('userConfigurations.favoriteDestroy');
        Route::get('userConfigurations.homepage', 'homepage')->name('userConfigurations.homepage');
        Route::get('userConfigurations/homeSet/{sidebarMenuItem}', 'homeSet')->name('userConfigurations.homeSet');
        Route::get('userConfigurations/homeUnset', 'homeUnset')->name('userConfigurations.homeUnset');
    });

    // Route::resource('sidebarMenus', SidebarMenuController::class)->except(['create','show','edit','store','destroy','update']);
    Route::controller(SidebarMenuController::class)->group(function () {
        Route::get('sidebarMenus', 'index')->name('sidebarMenus');
        Route::post('sidebarMenus/newMenuItem', 'newMenuItem')->name('sidebarMenus.newMenuItem');
        Route::post('sidebarMenus/newMenuFather', 'newMenuFather')->name('sidebarMenus.newMenuFather');
        Route::post('sidebarMenus/newMenuSubFather', 'newMenuSubFather')->name('sidebarMenus.newMenuSubFather');
        Route::put('sidebarMenus.updateItem/{sidebarMenuItem}', 'updateItem')->name('sidebarMenus.updateItem');
        Route::put('sidebarMenus.updateMenuFather/{sidebarMenuFather}', 'updateMenuFather')->name('sidebarMenus.updateMenuFather');
        Route::put('sidebarMenus.updateMenuSubFather/{sidebarMenuSubFather}', 'updateMenuSubFather')->name('sidebarMenus.updateMenuSubFather');
        Route::DELETE('sidebarMenus.destroyItem/{sidebarMenuItem}', 'destroyItem')->name('sidebarMenus.destroyItem');
        Route::DELETE('sidebarMenus.destroyMenuFather/{sidebarMenuFather}', 'destroyMenuFather')->name('sidebarMenus.destroyMenuFather');
        Route::DELETE('sidebarMenus.destroyMenuSubFather/{sidebarMenuSubFather}', 'destroyMenuSubFather')->name('sidebarMenus.destroyMenuSubFather');
    });

    Route::resource('customers', CustomerController::class)->except(['show']);
    Route::controller(CustomerController::class)->group(function () {
        Route::put('customers.addContact/{customer}', 'addContact')->name('customers.addContact');
        Route::DELETE('customers.deleteContact/{customerContact}', 'deleteContact')->name('customers.deleteContact');
        Route::get('customers/{customer}/editDocuments', 'editDocuments')->name('customers.editDocuments');
        Route::post('customers.addDocument/{customer}', 'addDocument')->name('customers.addDocument');
        Route::delete('customers.deleteDocument/{document}', 'deleteDocument')->name('customers.deleteDocument');
    });

    Route::resource('suppliers', SupplierController::class)->except(['show']);
    Route::controller(SupplierController::class)->group(function () {
        Route::put('suppliers.addContact/{supplier}', 'addContact')->name('suppliers.addContact');
        Route::DELETE('suppliers.deleteContact/{supplierContact}', 'deleteContact')->name('suppliers.deleteContact');
        Route::get('suppliers/{supplier}/editDocuments', 'editDocuments')->name('suppliers.editDocuments');
        Route::post('suppliers.addDocument/{supplier}', 'addDocument')->name('suppliers.addDocument');
        Route::delete('suppliers.deleteDocument/{document}', 'deleteDocument')->name('suppliers.deleteDocument');
    });

    Route::resource('documentTypes', DocumentTypeController::class)->except(['show']);

    Route::resource('documents', DocumentController::class)->except(['show','create','store']);
    Route::controller(DocumentController::class)->group(function () {
        Route::get('documents.customerProjects/{id}','customerProjects')->name('documents.customerProjects');
        Route::get('documents.customerOpportunities/{customer}','customerOpportunities')->name('documents.customerOpportunities');
        Route::get('documents.projectProjectChores/{project}','projectProjectChores')->name('documents.projectProjectChores');
        Route::get('documents.workerOpportunities/{worker}','workerOpportunities')->name('documents.workerOpportunities');
        Route::get('documents.massiveUpload','massiveUpload')->name('documents.massiveUpload');
        Route::post('documents.massiveUploadStoreWorker', 'massiveUploadStoreWorker')->name('documents.massiveUploadStoreWorker');
        Route::post('documents.massiveUploadStoreWorkers', 'massiveUploadStoreWorkers')->name('documents.massiveUploadStoreWorkers');
        Route::post('documents.massiveUploadStoreBusiness', 'massiveUploadStoreBusiness')->name('documents.massiveUploadStoreBusiness');
    });

    Route::resource('notifications', NotificationController::class);
    Route::controller(NotificationController::class)->group(function () {
        Route::get('notifications.markAsRead/{notification}','markAsRead')->name('notifications.markAsRead');
        Route::get('notifications/{notification}/sendEmail','sendEmail')->name('notifications.sendEmail');
    });

    Route::get('myNotifications', [MyNotificationController::class, 'index'])->name('myNotifications');
    Route::controller(MyNotificationController::class)->group(function () {
        Route::get('myNotifications/{notification}/markAsRead','markAsRead')->name('myNotifications.markAsRead');
    });


    Route::middleware(['profile.completed'])->group(function () {
        // Route::resource('events', EventController::class);
        // Route::resource('leaveRequests', LeaveRequestController::class)->except(['show']);
        // Route::controller(LeaveRequestController::class)->group(function () {
        //     Route::get('leaveRequests/{leaveRequest}/approve', 'approve')->name('leaveRequests.approve');
        // });
        // Route::resource('workerLeaveRequests', WorkerLeaveRequestController::class)->except(['show','create','edit','update','delete']);
    });

    Route::get('/clear-cache', function () {
        try {
            Artisan::call('config:clear');
            Artisan::call('config:cache');
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            return back()->with('info','Caché Limpiado');
        } catch (\Throwable $th) {
            return back();
        }
     });
});


