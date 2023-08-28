<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('collections')->group(function () {
    Route::post('/', [CollectionController::class, 'createCollection']);
    Route::get('/', [CollectionController::class, 'index']);
    Route::get('/{id}', [CollectionController::class, 'showDetails']);
    Route::get('/filter', [CollectionController::class, 'filter']); // Добавлен маршрут для filter
});
Route::post('contributors', 'App\Http\Controllers\ContributorController@addContributor');

