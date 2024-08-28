<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\SubKategoriController;
use App\Http\Controllers\API\SubSubKategoriController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\IklanController;
use App\Http\Controllers\API\OtherProductsController;
use App\Http\Controllers\API\OfficialStoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);



//Route Product
Route::apiResource('/product', ProductController::class);
Route::get('/katByProd', [ProductController::class, 'katByProd']);
Route::get('/prodByKat/{id_kat}', [ProductController::class, 'prodByKat']);
Route::get('/subKatByProd/{id_kat}', [ProductController::class, 'subKatByProd']);
Route::get('/sale', [ProductController::class, 'sale']);

//Route Other Product
Route::apiResource('/otherprod', OtherProductsController::class);

//Route Kategori Product
Route::apiResource('/kategori', KategoriController::class);

//Route Sub Kategori Product
Route::apiResource('/subkategori', SubKategoriController::class);

//Route Sub Kategori Product
Route::apiResource('/subsubkategori', SubSubKategoriController::class);

//Route Brands
Route::apiResource('/brand', BrandController::class);

// Route Banner Iklan
Route::apiResource('/iklan', IklanController::class);
Route::get('/iklanatas', [IklanController::class, 'iklanatas']);
Route::get('/iklanbawah', [IklanController::class, 'iklanbawah']);

//Route Official Store
Route::apiResource('/offstore', OfficialStoreController::class);


