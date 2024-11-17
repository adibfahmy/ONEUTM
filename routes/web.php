<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/', function () {
    return view('welcome');
});

// Route to display the catalog items
Route::get('/marketplace/catalog', [CatalogController::class, 'index'])->name('marketplace.index');

// Route to display the "Add Product" form
Route::get('/marketplace/product/create', [CatalogController::class, 'create'])->name('marketplace.create');

// Route to store the new product
Route::post('/marketplace/product', [CatalogController::class, 'store'])->name('marketplace.store');