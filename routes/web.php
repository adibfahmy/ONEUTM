<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< Updated upstream
// Route to display the catalog items
Route::get('/marketplace/catalog', [CatalogController::class, 'index'])->name('marketplace.index');

// Route to display the "Add Product" form
Route::get('/marketplace/product/create', [CatalogController::class, 'create'])->name('marketplace.create');

// Route to store the new product
Route::post('/marketplace/product', [CatalogController::class, 'store'])->name('marketplace.store');
=======
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
>>>>>>> Stashed changes
