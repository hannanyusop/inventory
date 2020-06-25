<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ItemController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\ReceiveStockController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TransferStockController;
use App\Http\Controllers\Backend\StockReportController;
use App\Http\Controllers\Backend\AccountController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => 'item/', 'as' => 'item.'], function(){

    Route::get('', [ItemController::class, 'index'])->name('index');
    Route::get('add', [ItemController::class, 'add'])->name('add');
    Route::post('add', [ItemController::class,'insert'])->name('insert');
    Route::get('view/{id}', [ItemController::class, 'view'])->name('view');
    Route::get('edit/{id}', [ItemController::class, 'edit'])->name('edit');
    Route::post('edit/{id}', [ItemController::class, 'update'])->name('update');

});

Route::group(['prefix' => 'account/', 'as' => 'account.'], function(){

    Route::get('', [AccountController::class, 'edit'])->name('edit');
    Route::post('update', [AccountController::class, 'update'])->name('update');
    Route::post('update-password', [AccountController::class, 'updatePassword'])->name('update-password');

});

Route::group(['prefix' => 'customer/', 'as' => 'customer.'], function(){

    Route::get('', [CustomerController::class, 'index'])->name('index');
    Route::get('add', [CustomerController::class, 'add'])->name('add');
    Route::post('add', [CustomerController::class,'insert'])->name('insert');
    Route::get('view/{id}', [CustomerController::class, 'view'])->name('view');
    Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    Route::post('edit/{id}', [CustomerController::class, 'update'])->name('update');
    Route::get('get/{id}', [CustomerController::class, 'getData'])->name('get-invoice');

});

Route::group(['prefix' => 'category/', 'as' => 'category.'], function(){

    Route::get('', [CategoryController::class, 'index'])->name('index');
    Route::get('add', [CategoryController::class, 'add'])->name('add');
    Route::post('add', [CategoryController::class,'insert'])->name('insert');
    Route::get('view/{id}', [CategoryController::class, 'view'])->name('view');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::post('edit/{id}', [CategoryController::class, 'update'])->name('update');

});

Route::group(['prefix' => 'supplier/', 'as' => 'supplier.'], function(){

    Route::get('', [SupplierController::class, 'index'])->name('index');
    Route::get('add', [SupplierController::class, 'add'])->name('add');
    Route::post('add', [SupplierController::class,'insert'])->name('insert');
    Route::get('view/{id}', [SupplierController::class, 'view'])->name('view');
    Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('edit');
    Route::post('edit/{id}', [SupplierController::class, 'update'])->name('update');
    Route::get('get/{id}', [SupplierController::class, 'getData'])->name('get-invoice');

});

Route::group(['prefix' => 'stock-receive/', 'as' => 'stock-receive.'], function(){

    Route::get('', [ReceiveStockController::class, 'index'])->name('index');
    Route::get('add', [ReceiveStockController::class, 'add'])->name('add');
    Route::post('add', [ReceiveStockController::class, 'add'])->name('add');
    Route::get('remove-from-list/{item_id}', [ReceiveStockController::class, 'removeFromList'])->name('remove-from-list');
    Route::post('insert', [ReceiveStockController::class,'insert'])->name('insert');
    Route::get('view/{id}', [ReceiveStockController::class, 'view'])->name('view');


});

Route::group(['prefix' => 'stock-transfer/', 'as' => 'stock-transfer.'], function(){

    Route::get('', [TransferStockController::class, 'index'])->name('index');
    Route::get('add', [TransferStockController::class, 'add'])->name('add');
    Route::post('add', [TransferStockController::class, 'add'])->name('add');
    Route::get('remove-from-list/{item_id}', [TransferStockController::class, 'removeFromList'])->name('remove-from-list');
    Route::post('insert', [TransferStockController::class,'insert'])->name('insert');
    Route::get('view/{id}', [TransferStockController::class, 'view'])->name('view');


});

Route::group(['prefix' => 'stock-report/', 'as' => 'stock-report.'], function(){

    Route::get('', [StockReportController::class, 'index'])->name('index');
    Route::get('prediction', [StockReportController::class, 'prediction'])->name('prediction');



});

