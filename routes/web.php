<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'welcome']);

Route::view('/admin-login','admin-login')->name('adminLogin');

Route::controller(AdminController::class)->group(function () {
    Route::post('/admin-login', 'login')->name('adminLogin');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/admin-categories', 'categories')->name('adminCategory');
    Route::get('/admin-logout', 'logout')->name('adminLogout');
    Route::post('/add-categories', 'addCategories')->name('addCategories');
    Route::get('/admin-categories/delete/{id}', 'deleteCategories')->name('deleteCategory');
    Route::get('/add-quiz', 'addQuiz')->name('addQuiz');
    Route::post('/add-mcq', 'addMcqs')->name('addMcq');
    Route::get('/show-quiz/{id}/{quizName}', 'showQuiz')->name('showQuiz');
    Route::get('/quiz-list/{id}/{category}', 'quizList')->name('quizList');
});