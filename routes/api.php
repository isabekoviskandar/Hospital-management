<?php

use App\Api\Controllers\DirectionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/get-directions' , [DirectionsController::class , 'index']);
Route::post('/create-direction' , [DirectionsController::class , 'store']);
Route::put('/update-direction/{id}' , [DirectionsController::class , 'update']);
Route::delete('/delete-direction/{id}', [DirectionsController::class , 'destroy']);