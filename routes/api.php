<?php

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Magazine\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register' , [RegisterController::class , 'register']);
Route::post('login' , [RegisterController::class , 'Login']);

Route::middleware('auth:api')->group( function (){
   Route::resource('products' , ProductController::class);
   Route::resource('tags', TagController::class);
   Route::resource('sliders', \App\Http\Controllers\Magazine\SliderController::class);
});
