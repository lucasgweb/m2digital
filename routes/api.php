<?php

use App\Http\Controllers\Api\CampaignController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
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
Route::put('/cities/{id}',[CityController::class,'update']);
Route::get('/cities/{id}',[CityController::class,'show']);
Route::delete('/cities/{id}',[CityController::class,'destroy']);
Route::get('/cities',[CityController::class,'index']);
Route::post('/cities',[CityController::class,'store']);

Route::put('/groups/{id}',[GroupController::class,'update']);
Route::get('/groups/{id}',[GroupController::class,'show']);
Route::delete('/groups/{id}',[GroupController::class,'destroy']);
Route::get('/groups',[GroupController::class,'index']);
Route::post('/groups',[GroupController::class,'store']);

Route::put('/campaigns/{id}',[CampaignController::class,'update']);
Route::get('/campaigns/{id}',[CampaignController::class,'show']);
Route::delete('/campaigns/{id}',[CampaignController::class,'destroy']);
Route::get('/campaigns',[CampaignController::class,'index']);
Route::post('/campaigns',[CampaignController::class,'store']);

Route::put('/products/{id}',[ProductController::class,'update']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::delete('/products/{id}',[ProductController::class,'destroy']);
Route::get('/products',[ProductController::class,'index']);
Route::post('/products',[ProductController::class,'store']);

Route::put('/discounts/{id}',[DiscountController::class,'update']);
Route::get('/discounts/{id}',[DiscountController::class,'show']);
Route::delete('/discounts/{id}',[DiscountController::class,'destroy']);
Route::get('/discounts',[DiscountController::class,'index']);
Route::post('/discounts',[DiscountController::class,'store']);

