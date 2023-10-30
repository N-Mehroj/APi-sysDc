<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Admin\RatesApi;
use App\Http\Controllers\Api\V1\Admin\ServerApi;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/rates/indexDefinition', [RatesApi::class, 'index']);
Route::post('/rates/storeDefinition', [RatesApi::class, 'store']);
Route::post('/rates/updateDefinition', [RatesApi::class, 'update']);
Route::delete('/rates/destroyDefinition', [RatesApi::class, 'destroy']);

Route::get('/server/indexServer', [ServerApi::class, 'index']);
Route::post('/server/storeServer', [ServerApi::class, 'store']);
Route::post('/server/updateServer', [ServerApi::class, 'update']);
Route::delete('/server/destroyServer', [ServerApi::class, 'destroy']);
