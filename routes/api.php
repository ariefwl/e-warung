<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\SubKategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

//Route Kategori Product
Route::post('/createKat', [KategoriController::class, 'store']);

//Route Sub Kategori Product
Route::post('/createSubKat', [SubKategoriController::class, 'store']);

//Route Product
Route::post('/storeProduct', [ProductController::class, 'store']);
