<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\BrgyController;
use App\Http\Controllers\CityMunController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DownloadableController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserHistoryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('/pages.welcome');
});


Route::get('/developments', [PageController::class, 'developments'])->name('developments');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');

Route::GET('select-province-name', [ProvinceController::class, 'selectProvincesListJson'])->name('select-province-name');
Route::GET('select-province-by-region-id',[ProvinceController::class, 'selectListByRegionIDJson'])->name('select-province-by-region-id');
Route::GET('select-citymun-by-province-id', [CityMunController::class, 'selectListByProvinceIDJson'])->name('select-citymun-by-province-id');
Route::GET('select-barangay-by-citymun-id',[BrgyController::class, 'selectListByCityMunIDJson'])->name('select-barangay-by-citymun-id');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::GET('profile',[ProfileController::class, 'show'])->name('my-profile');
    Route::MATCH(['GET','POST'],'change-password',[PasswordChangeController::class, 'show'])->name('change-password');

    //Downloadable
    Route::get('downloadables', [DownloadableController::class, 'index'])->name('downloadables.index');
    Route::get('downloadable/open-file/{file?}', [DownloadableController::class, 'openFile'])->name('downloadable.open-file');
    Route::get('downloadable/{id}/edit', [DownloadableController::class, 'index'])->name('downloadable.edit');
    Route::POST('downloadables/store', [DownloadableController::class, 'store'])->name('downloadable.store');
    Route::DELETE('downloadable/{id}/destroy', [DownloadableController::class, 'destroy'])->name('downloadable.destroy');

    

    Route::get('/developers', [DeveloperController::class, 'index'])->name('developers.index');
    Route::get('/properties', [ListingController::class, 'properties'])->name('properties');
    Route::get('/agents', [AgentController::class, 'agents'])->name('agents.index');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::middleware(['administrator'])->group(function () {
        Route::GET('/downloadable/create', [DownloadableController::class, 'create'])->name('downloadable.create');
        Route::GET('/user-history', [UserHistoryController::class, 'index'])->name('user-history');
        Route::get('region-setting', [PageController::class, 'about'])->name('region-setting');
        Route::get('province-setting', [PageController::class, 'about'])->name('province-setting');
        Route::get('/citymun-setting', [PageController::class, 'about'])->name('citymun-setting');
        
        Route::GET('roles','Other\AccessController@roles')->name('roles');
        Route::GET('user-roles','Other\AccessController@userRoles')->name('user-roles');
        Route::GET('role-permissions','Other\AccessController@permissions')->name('role-permissions');
        Route::MATCH(['GET','POST'],'role/{id}/add-permission','Other\RoleController@addPermission')->name('role.add-permission');
        
        //CRUD
        Route::POST('save-new-permission','Other\PermissionController@store')->name('permission.store');
        Route::POST('update-permission','Other\PermissionController@update')->name('permission.update');
        Route::POST('save-new-role','Other\RoleController@store')->name('role.store');
        Route::POST('update-role','Other\RoleController@update')->name('role.update');
    });

});