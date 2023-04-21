<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::get("/",[\App\Http\Controllers\api\v1\IndexController::class,"index"])->name("index");

Route::post("/register", [\App\Http\Controllers\api\v1\AuthController::class, "register"])->name("register");
Route::post("/login", [\App\Http\Controllers\api\v1\AuthController::class, "login"])->name("login");

Route::group(["middleware"=>["auth:sanctum","checkAdmin"],"prefix"=>"admin"],function (){
    Route::apiResource("service",\App\Http\Controllers\api\v1\admin\ServiceComtroller::class);
});

Route::group(["middleware"=>"auth:sanctum"],function () {
    Route::post("/logout",[\App\Http\Controllers\api\v1\AuthController::class,"logout"]);
});

Route::group(["prefix"=>"service","middleware"=>"auth:sanctum"],function (){
    Route::post("/store",[\App\Http\Controllers\api\v1\ServiceController::class,"store"]);
    Route::get("/bill-items",[\App\Http\Controllers\api\v1\ServiceController::class,"allBillItems"]);
    Route::get("/bills",[\App\Http\Controllers\api\v1\ServiceController::class,"allPublishedBills"]);
    Route::get("/current-month-bill",[\App\Http\Controllers\api\v1\ServiceController::class,"currentMonthBills"]);
    Route::get("/bills/{year}/{month}",[\App\Http\Controllers\api\v1\ServiceController::class,"specificDate"]);
});


