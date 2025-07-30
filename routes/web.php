<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// AdminController
Route::get('/' , [AdminController::class, 'register'])->name('register');
Route::post('/register-submit' , [AdminController::class, 'registersubmit'])->name('register-submit');
Route::get('/otp-check' , [AdminController::class, 'otp'])->name('otp-check'); 
Route::post('/otp-submit' , [AdminController::class, 'otpSubmit'])->name('otp-submit');
Route::get('/admin-login' , [AdminController::class, 'adminlogin'])->name('admin-login');
Route::post('/admin-submit' , [AdminController::class, 'adminSubmit'])->name('admin-submit');

// UserController
Route::get('/user-dashboard' , [UserController::class , 'dashboard'])->name('dashboard');
Route::get('/showAll-categories' , [UserController::class , 'showAllCategories'])->name('showAll-categories');
Route::get('/mcq-paper/{id}' , [UserController::class , 'mcqPaper'])->name('mcq-paper');
Route::post('/mcq-result' , [UserController::class, 'mcqResult'])->name('mcq-result');

// DashboardController
Route::get('/admin-dashboard' , [DashboardController::class , 'mainDashboard'])->name('admin-dashboard');
Route::get('/categories' , [DashboardController::class , 'categories'])->name('categories');
Route::post('/categories-add' , [DashboardController::class , 'categoriesAdd'])->name('categories-add');
Route::post('/delete-categories' , [DashboardController::class , 'deletCategories'])->name('delete-categories');
Route::post('/search-categories' , [DashboardController::class , 'searchCategories'])->name('search-categories');
Route::get('/get-category-content' , [DashboardController::class , 'getCategoryContent'])->name('get-category-content');
Route::post('/add-mcq' , [DashboardController::class , 'addMcq'])->name('add-mcq');