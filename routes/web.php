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
Route::GET('select-province-by-region-id', [ProvinceController::class, 'selectListByRegionIDJson'])->name('select-province-by-region-id');
Route::GET('select-citymun-by-province-id', [CityMunController::class, 'selectListByProvinceIDJson'])->name('select-citymun-by-province-id');
Route::GET('select-barangay-by-citymun-id', [BrgyController::class, 'selectListByCityMunIDJson'])->name('select-barangay-by-citymun-id');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::GET('profile', [ProfileController::class, 'show'])->name('my-profile');
    Route::MATCH(['GET', 'POST'], 'change-password', [PasswordChangeController::class, 'show'])->name('change-password');

    // Downloadable
    Route::get('downloadables', [DownloadableController::class, 'index'])->name('downloadables.index');
    Route::get('downloadable/{id}/edit', [DownloadableController::class, 'edit'])->name('downloadable.edit');
    Route::POST('downloadables/store', [DownloadableController::class, 'store'])->name('downloadable.store');
    Route::PATCH('downloadables/{id}/update', [DownloadableController::class, 'update'])->name('downloadable.update');
    Route::DELETE('downloadable/{id}/destroy', [DownloadableController::class, 'destroy'])->name('downloadable.destroy');
    Route::PATCH('downloadable/{id}/destroy-file', [DownloadableController::class, 'destroyFile'])->name('downloadable.destroy-file');

    // Developer
    Route::GET('developers', [DeveloperController::class, 'index'])->name('developers.index');
    Route::GET('developer/create', [DeveloperController::class, 'create'])->name('developer.create');
    Route::GET('developer/{id}/edit', [DeveloperController::class, 'edit'])->name('developer.edit');
    Route::GET('developer/{id}/show', [DeveloperController::class, 'show'])->name('developer.show');
    Route::PATCH('developer/{id}/update', [DeveloperController::class, 'update'])->name('developer.update');
    Route::POST('developer/store', [DeveloperController::class, 'store'])->name('developer.store');
    Route::DELETE('developer/{id}/destroy', [DeveloperController::class, 'destroy'])->name('developer.destroy');

    // Listings
    Route::GET('/listings', [ListingController::class, 'index'])->name('listings.index');
    Route::GET('listing/create', [ListingController::class, 'create'])->name('listing.create');
    Route::GET('listing/{id}/edit', [ListingController::class, 'edit'])->name('listing.edit');
    Route::GET('listing/{id}/show', [ListingController::class, 'show'])->name('listing.show');
    Route::PATCH('listing/{id}/update', [ListingController::class, 'update'])->name('listing.update');
    Route::POST('listing/store', [ListingController::class, 'store'])->name('listing.store');
    Route::DELETE('listing/{id}/destroy', [ListingController::class, 'destroy'])->name('listing.destroy');
    // Listing photos
    Route::GET('listing/{id}/photos', [ListingController::class, 'photos'])->name('listing.photos');
    Route::POST('listing/{id}/photos', [ListingController::class, 'storePhoto'])->name('listing.photos.store');
    Route::DELETE('listing-photo/{photoId}', [ListingController::class, 'destroyPhoto'])->name('listing.photo.destroy');
    Route::PATCH('listing-photo/{photoId}/primary', [ListingController::class, 'setPrimaryPhoto'])->name('listing.photo.primary');

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

        Route::GET('roles', 'Other\AccessController@roles')->name('roles');
        Route::GET('user-roles', 'Other\AccessController@userRoles')->name('user-roles');
        Route::GET('role-permissions', 'Other\AccessController@permissions')->name('role-permissions');
        Route::MATCH(['GET', 'POST'], 'role/{id}/add-permission', 'Other\RoleController@addPermission')->name('role.add-permission');

        // CRUD
        Route::POST('save-new-permission', 'Other\PermissionController@store')->name('permission.store');
        Route::POST('update-permission', 'Other\PermissionController@update')->name('permission.update');
        Route::POST('save-new-role', 'Other\RoleController@store')->name('role.store');
        Route::POST('update-role', 'Other\RoleController@update')->name('role.update');
    });

});
