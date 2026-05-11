<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\PropertyController;


Route::get('/', function () {
    return view('/pages.home');
});
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/properties', [PageController::class, 'properties'])->name('properties');
Route::get('/agents', [PageController::class, 'agents'])->name('agents');
Route::get('/developments', [PageController::class, 'developments'])->name('developments');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name('properties.show');