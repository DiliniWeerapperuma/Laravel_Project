<?php

use App\Http\Controllers\ZoneController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminWelcomeController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PurchaseOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', function () {
//     return view('adminwelcome');
// });

// Route :: get('/zone/all', function(){
//     return view('zone.index');
// });

// zone

Route::get('/zone/all' , [ZoneController ::class, 'index']) ->name('zone.index');
Route::get('/zone/add' , [ZoneController ::class, 'add']) ->name('zone.add');
Route::post('/zone/store', [ZoneController ::class, 'store']) ->name('zone.store');
Route::get('/zone/{zone_id}', [ZoneController ::class, 'edit']) ->name('zone.edit');
Route::put('/zone/{zone_id}', [ZoneController ::class, 'update']) ->name('zone.update');
Route::get('/zone/delete/{zone_id}', [ZoneController ::class, 'delete']) ->name('zone.delete');
Route::get('/zone/show/{id}', [ZoneController::class, 'show'])->name('zone.show');


// Region

Route::get('/region/all', [RegionController ::class, 'index']) ->name('region.index');
Route::get('/region/add' , [RegionController ::class, 'add']) ->name('region.add');
Route::post('/region/store', [RegionController ::class, 'store']) ->name('region.store');
Route::get('/region/{region_id}', [RegionController ::class, 'edit']) ->name('region.edit');
Route::put('/region/{region_id}', [RegionController ::class, 'update']) ->name('region.update');
Route::get('/region/delete/{region_id}', [RegionController ::class, 'delete']) ->name('region.delete');
Route::get('/region/show/{id}', [RegionController::class, 'show'])->name('region.show');



// Territory

Route::get('/territory/all', [TerritoryController ::class, 'index']) ->name('territory.index');
Route::get('/territory/add' , [TerritoryController ::class, 'add']) ->name('territory.add');
Route::post('/territory/store', [TerritoryController ::class, 'store']) ->name('territory.store');
Route::get('/territory/{territory_id}', [TerritoryController ::class, 'edit']) ->name('territory.edit');
Route::put('/territory/{territory_id}', [TerritoryController ::class, 'update']) ->name('territory.update');
Route::get('/territory/delete/{territory_id}', [TerritoryController ::class, 'delete']) ->name('territory.delete');
Route::get('/territory/show/{id}', [TerritoryController::class, 'show'])->name('territory.show');



// User

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerSave'])->name('register.save');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login/action', [AuthController::class, 'loginAction'])->name('login.action');




// Product

Route::get('/product/all', [ProductController ::class, 'index']) ->name('product.index');
Route::get('/product/add' , [ProductController ::class, 'add']) ->name('product.add');
Route::post('/product/store', [ProductController ::class, 'store']) ->name('product.store');
Route::get('/product/{product_id}', [ProductController ::class, 'edit']) ->name('product.edit');
Route::put('/product/{product_id}', [ProductController ::class, 'update']) ->name('product.update');
Route::get('/product/delete/{product_id}', [ProductController ::class, 'delete']) ->name('product.delete');
Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');




Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminWelcomeController::class , 'index'])->name('adminwelcome');
    Route::get('/distributor', [DistributorController::class , 'index'])->name('distributor');

//purchaseorder

    Route::get('/purchaseorder/add', [PurchaseOrderController ::class, 'index']) ->name('purchaseorder.add');
    Route::post('/purchaseorder/store', [PurchaseOrderController ::class, 'store']) ->name('purchaseorder.store');
    Route::get('/purchaseorder/view', [PurchaseOrderController ::class, 'view']) ->name('purchaseorder.view');
    Route::post('/purchaseorder/po_data', [PurchaseOrderController ::class, 'po_data']) ->name('purchaseorder.po_data');
    Route::get('/purchaseorder/show/{id}', [PurchaseOrderController::class, 'show'])->name('purchaseorder.show');
    Route::get('/purchaseorder/pdf/{id}', [PurchaseOrderController::class, 'pdf'])->name('purchaseorder.pdf');
    Route::post('/purchaseorder/export', [PurchaseOrderController::class, 'export'])->name('purchaseorder.export');


});



