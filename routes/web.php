<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;


Route::get('user/home', [UserController::class, 'userHome'])->name('user.home')->middleware('isUserLoggedIn');
Route::get('',[UserController::class, 'redirectToUser']);
Route::get('user/registration', [UserController::class, 'registration'])->name('user.registration');
Route::post('user/db/registration', [UserController::class, 'registrationDB'])->name('user.db.registration');
Route::get('user/login', [UserController::class, 'loginPage'])->name('user.login');
Route::get('product/update/{id}',[ProductController::class, 'updateProduct'])->name('updateProduct');
Route::post('user/db/login', [UserController::class, 'login'])->name('user.db.login');

Route::post('user/product/add/',[ProductController::class, 'addProduct'])->name('addProduct')->middleware('isUserLoggedIn');
Route::get('user/addOrUpdateSubcatgory/', [ProductController::class, 'addOrUpdateSubcatgory'])->name('addOrUpdateSubcatgory')->middleware('isUserLoggedIn');
Route::get('user/addOrUpdateCatgory/', [ProductController::class, 'addOrUpdateCatgory'])->name('addOrUpdateCatgory')->middleware('isUserLoggedIn');



Route::post('user/storeSubategory', [ProductController::class, 'storeSubategory'])->name('storeSubategory')->middleware('isUserLoggedIn');
Route::post('user/storeCategory',[ProductController::class, 'storeCategory'])->name('storeCategory')->middleware('isUserLoggedIn');


Route::get('category/delete/{id}',[ProductController::class, 'cat_delete'])->middleware('isUserLoggedIn');
Route::get('subcategory/delete/{id}',[ProductController::class, 'sub_delete'])->middleware('isUserLoggedIn');
Route::get('product/delete/{id}',[ProductController::class, 'delete'])->middleware('isUserLoggedIn');

Route::get('user/product/order/{id}',[ProductController::class, 'orderStore'])->middleware('isUserLoggedIn');
Route::post('/update-product-order', [ProductController::class, 'updateOrder'])->name('update.product.order')->middleware('isUserLoggedIn');



