<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;


Route::get('/', function () {
    return redirecct()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Brands
    Route::resource('brands', BrandController::class)->except(['show']);

    //Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    //Items
    Route::resource('items', ItemController::class)->except(['show']);

});

require __DIR__.'/auth.php';