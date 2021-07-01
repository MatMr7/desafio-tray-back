<?php

use App\Http\Controllers\Api\{
    SellerController,
    SaleController
};
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

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//======================= Seller Routes ==========================
Route::post('/seller',[SellerController::class,'store']);
Route::get('/seller',[SellerController::class,'index']);

//======================= Sales Routes ==========================
Route::post('/sale',[SaleController::class,'store']);
Route::get('/sale/{seller_id}',[SaleController::class,'index']);
