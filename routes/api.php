<?php

use App\Api\Controllers\DirectionsController;
use App\Api\Controllers\DoctorController;
use App\Api\Controllers\ServiceController;
use App\Domain\Doctor\DTO\DoctorCreateDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/directions' , [DirectionsController::class , 'index']);
Route::post('/create-direction' , [DirectionsController::class , 'store']);
Route::put('/update-direction/{id}' , [DirectionsController::class , 'update']);
Route::delete('/delete-direction/{id}', [DirectionsController::class , 'destroy']);

Route::get('/services' , [ ServiceController::class , 'index']);
Route::post('/create-service' , [ServiceController::class , 'store']);
Route::put('/update-service/{id}' , [ServiceController::class , 'update']);
Route::delete('/delete-service/{id}' , [ServiceController::class , 'destroy']);

Route::get('/doctors' , [DoctorController::class , 'index']);
Route::post('/create-doctor' , [DoctorController::class , 'store']);