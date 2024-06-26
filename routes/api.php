<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\TypeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::middleware(['auth:api','scope:user-info'])->get('/user',function (Request $request){
//   return $request->user();
//});
Route::apiResource('animals',AnimalController::class);
Route::apiResource('types',TypeController::class);
//Route::post('/users/{user}/animals',function (){
//    //do something
//})->middleware('scopes:create-animals,user-info');

