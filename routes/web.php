<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// AdminController
Route::get('/' , [AdminController::class, 'register'])->name('register');
Route::post('/register-submit' , [AdminController::class, 'registersubmit'])->name('register-submit');
Route::get('/otp-check' , [AdminController::class, 'otp'])->name('otp-check'); 
Route::post('/otp-submit' , [AdminController::class, 'otpSubmit'])->name('otp-submit');
Route::get('/admin-login' , [AdminController::class, 'adminlogin'])->name('admin-login');
Route::post('/admin-submit' , [AdminController::class, 'adminSubmit'])->name('admin-submit');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

// UserController
Route::get('/user-dashboard' , [UserController::class , 'dashboard'])->name('dashboard');
Route::get('/showAll-categories' , [UserController::class , 'showAllCategories'])->name('showAll-categories');
Route::get('/mcq-paper/{id}' , [UserController::class , 'mcqPaper'])->name('mcq-paper');
Route::post('/mcq-result' , [UserController::class, 'mcqResult'])->name('mcq-result');
Route::post('/mcq-resultTimeout' , [UserController::class, 'mcqResultTimeOut'])->name('mcq-resultTimeout');
Route::get('/quiz-withTimeout' , [UserController::class, 'quizWithTimeout'])->name('quiz-withTimeout');
Route::post('/add-resultTimeAndAns' , [UserController::class, 'addResultTimeAndAns'])->name('add-resultTimeAndAns');
Route::get('/listOfAllUser' , [UserController::class, 'listOfAllUser'])->name('listOfAllUser');
Route::get('/listOfAllUser_user' , [UserController::class, 'listOfAllUser_user'])->name('listOfAllUser_user');
Route::post('/change-password' , [UserController::class, 'changePassword'])->name('change-password');

// DashboardController
Route::get('/admin-dashboard' , [DashboardController::class , 'mainDashboard'])->name('admin-dashboard');
Route::get('/categories' , [DashboardController::class , 'categories'])->name('categories');
Route::post('/categories-add' , [DashboardController::class , 'categoriesAdd'])->name('categories-add');
Route::post('/delete-categories' , [DashboardController::class , 'deletCategories'])->name('delete-categories');
Route::post('/search-categories' , [DashboardController::class , 'searchCategories'])->name('search-categories');
Route::get('/get-category-content' , [DashboardController::class , 'getCategoryContent'])->name('get-category-content');
Route::post('/add-mcq' , [DashboardController::class , 'addMcq'])->name('add-mcq');

//Mail send route
Route::get('send-mail' , [MailController::class , 'sendMail'])->name('send-mail');