<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ParcelController;


Route::get('/', function () {
    return view('index') ;
})->name('home');

// Route::get('/test', function() {
//     return view('index');
// });

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function() {
    Route::get('/parcels', [ParcelController::class, 'index'])->name('parcel.index');
    Route::get('/parcels/track/', [ParcelController::class, 'index'])->name('parcel.track');
    Route::get('/parcels/create', [ParcelController::class, 'create'])->name('parcel.create');
    Route::post('/parcels/store', [ParcelController::class, 'store'])->name('parcel.store');
    Route::get('/parcels/track/{id}', [ParcelController::class, 'track'])->name('parcel.track');
    Route::post('/parcels/pickup/{id}', [ParcelController::class, 'pickup'])->name('parcel.pickup');
    Route::post('/parcels/deliver/{id}', [ParcelController::class, 'deliver'])->name('parcel.deliver');
    Route::post('/parcels/{parcel}/accept-order', [ParcelController::class, 'acceptOrder'])->name('parcel.acceptOrder');
    Route::delete('/parcels/{parcel}', [ParcelController::class, 'delete'])->name('parcel.delete');
    Route::resource('parcels', ParcelController::class);
    Route::post('/parcels/{parcel}/pickup', [ParcelController::class, 'pickup'])->name('parcel.pickup');
    Route::post('/parcels/{parcel}/update-status', [ParcelController::class, 'updateStatus'])->name('parcel.updateStatus');
    Route::get('/parcel-service', [ParcelController::class, 'service'])->name('parcel.service');
    Route::delete('/parcel/{id}', [ParcelController::class, 'destroy'])->name('parcel.destroy');
    Route::post('/parcels/{parcel}/accept-order', [ParcelController::class, 'acceptOrder'])->name('parcel.acceptOrder');
    Route::post('/parcel/{parcel}/cancel', [ParcelController::class, 'cancelOrder'])->name('parcel.cancelOrder');
    Route::post('/parcel/{parcel}/accept', [ParcelController::class, 'acceptOrder'])->name('parcel.acceptOrder');
    Route::get('/parcel/{parcel}/track', [ParcelController::class, 'track'])->name('parcel.track');
    Route::post('/parcel/{parcel}/update-status', [ParcelController::class, 'updateStatus'])->name('parcel.updateStatus');
    Route::get('/my-parcels', [ParcelController::class, 'myParcels'])->name('parcel.myParcels');

});

Route::middleware('auth')->group(function() {

    // Route to display the catalog items
    Route::get('/marketplace/catalog', [CatalogController::class, 'index'])->name('marketplace.marketindex');
    // Route to display the "Add Product" form
    Route::get('/marketplace/product/create', [CatalogController::class, 'create'])->name('marketplace.marketcreate');
    // Route to store the new product
    Route::post('/marketplace/product', [CatalogController::class, 'store'])->name('marketplace.store');
    // Route to delete a product
    Route::delete('/marketplace/product/{id}', [CatalogController::class, 'destroy'])->name('marketplace.destroy');

    Route::get('/marketplace/{id}', [CatalogController::class, 'show'])->name('marketplace.marketshow');

    Route::get('/marketplace', [CatalogController::class, 'search'])->name('marketplace.marketindex');

    // Route to clear search and go back to the index page
    Route::get('/marketplace/clearsearch', [CatalogController::class, 'clearSearch'])->name('marketplace.clearsearch');

    Route::get('/marketplace/{id}/edit', [CatalogController::class, 'edit'])->name('marketplace.marketedit');

    Route::put('/marketplace/{id}', [CatalogController::class, 'update'])->name('marketplace.marketupdate');




});

require __DIR__.'/auth.php';
