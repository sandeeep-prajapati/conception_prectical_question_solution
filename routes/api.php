<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\helperFunctions;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('product/getAllCat',[helperFunctions::class,'getAllCat']);
Route::get('product/getAllSubcat/{cat_id?}',[helperFunctions::class,'getAllSubcat']);
Route::get('product/productdetails/{cat_id?}/{sub_id?}', [helperFunctions::class,'productdetails']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
