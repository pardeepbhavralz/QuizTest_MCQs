<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum'); 

// Postman 
// Route::post('/submit-form' , [PostController::class , 'submitform']);
Route::post('/submit-form' , [AdminController::class , 'registersubmit']);
Route::post('/otp-submit' , [AdminController::class , 'otpSubmit']);