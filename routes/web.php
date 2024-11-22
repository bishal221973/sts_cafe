<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('category')->group(function(){
    Route::get('/',[CategoryController::class,'index'])->name('category.index');
    Route::post('store',[CategoryController::class,'store'])->name('category.store');
    Route::get('{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('{category}/update',[CategoryController::class,'update'])->name('category.update');
    Route::delete('{category}/delete',[CategoryController::class,'delete'])->name('category.delete');
});


Route::prefix('sub-category')->group(function(){
    Route::get('/',[SubCategoryController::class,'index'])->name('subCategory.index');
    Route::post('store',[SubCategoryController::class,'store'])->name('subCategory.store');
    Route::get('{subCategory}/edit',[SubCategoryController::class,'edit'])->name('subCategory.edit');
    Route::put('{subCategory}/update',[SubCategoryController::class,'update'])->name('subCategory.update');
    Route::delete('{subCategory}/delete',[SubCategoryController::class,'delete'])->name('subCategory.delete');
});
Route::prefix('product')->group(function(){
    Route::get('/',[ProductController::class,'index'])->name('product.index');
    Route::get('sub-category/{id}',[ProductController::class,'subCategory'])->name('product.subCategory');
    Route::post('store',[ProductController::class,'store'])->name('product.store');
    Route::get('{product}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::put('{product}/update',[ProductController::class,'update'])->name('product.update');
    Route::delete('{product}/delete',[ProductController::class,'delete'])->name('product.delete');
});

Route::prefix('supplier')->group(function(){
    Route::get('/',[SupplierController::class,'index'])->name('supplier.index');
    Route::post('store',[SupplierController::class,'store'])->name('supplier.store');
    Route::get('{supplier}/edit',[SupplierController::class,'edit'])->name('supplier.edit');
    Route::put('{supplier}/update',[SupplierController::class,'update'])->name('supplier.update');
    Route::delete('{supplier}/delete',[SupplierController::class,'delete'])->name('supplier.delete');
});


Route::get('purchase',[PurchaseController::class,'index'])->name('purchase.index');
Route::get('purchase/create',[PurchaseController::class,'create'])->name('purchase.create');
Route::post('purchase/store',[PurchaseController::class,'store'])->name('purchase.store');
Route::delete('purchase/{purchase}/delete',[PurchaseController::class,'delete'])->name('purchase.delete');
Route::get('purchase/{purchase}/edit',[PurchaseController::class,'edit'])->name('purchase.edit');
Route::put('purchase/{purchase}/update',[PurchaseController::class,'update'])->name('purchase.update');

Route::get('stock',[PurchaseController::class,'stock'])->name('purchase.stock');
Route::get('pos',[PosController::class,'pos'])->name('purchase.pos');


Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class,'index'])->name('user.index');
    Route::post('store',[UserController::class,'store'])->name('user.store');
    Route::get('{user}/edit',[UserController::class,'edit'])->name('user.edit');
    Route::put('{user}/update',[UserController::class,'update'])->name('user.update');
    Route::delete('{user}/delete',[UserController::class,'delete'])->name('user.delete');
    Route::get('{user}/show',[UserController::class,'show'])->name('user.show');
    Route::put('{user}/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::put('{user}/permissions', [UserController::class, 'syncPermissions'])->name('user.permission');
});



Route::get('setting',[SettingController::class,'index'])->name('setting.index');
Route::post('setting',[SettingController::class,'syncSetting'])->name('setting.syncSetting');
Route::prefix('report')->group(function(){
    Route::get('daily-report',[ReportController::class,'normal'])->name('report.normal');
    Route::get('monthly-report',[ReportController::class,'monthly'])->name('report.monthly');
    Route::get('normal-report-pdf',[ReportController::class,'normalPdf'])->name('report.normalPdf');
    Route::get('product-wise-report',[ReportController::class,'productWise'])->name('report.productWise');
    Route::get('user-wise-report',[ReportController::class,'userWise'])->name('report.userWise');
});
Route::prefix('combo')->group(function(){
    Route::get('/',[ComboController::class,'index'])->name('combo.index');
    Route::get('/create',[ComboController::class,'create'])->name('combo.create');
    Route::post('store',[ComboController::class,'store'])->name('combo.store');
    Route::get('{combo}/edit',[ComboController::class,'edit'])->name('combo.edit');
    Route::put('{combo}/update',[ComboController::class,'update'])->name('combo.update');
    Route::delete('{combo}/delete',[ComboController::class,'delete'])->name('combo.delete');
    Route::get('{combo}/products',[ComboController::class,'products'])->name('combo.products');


    Route::delete('{subProduct}/delete/product',[ComboController::class,'productDelete'])->name('combo.productDelete');
    Route::post('add/product',[ComboController::class,'addProduct'])->name('combo.addProduct');



});
