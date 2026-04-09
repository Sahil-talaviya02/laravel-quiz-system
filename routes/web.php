<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {

    Route::get('/', 'welcome')->name('home');

    Route::get('/user-quiz-list/{id}/{quizName}', 'userQuizList')->name('userQuizList');

    Route::get('/start-quiz/{id}/{name}', 'startQuiz')->name('startQuiz');

    // Auth pages
    Route::get('/login', 'userLoginQuiz')->name('loginPage');
    Route::get('/signup', function () {
        return view('user-signup');
    })->name('signupPage');

    // Auth actions
    Route::post('/login', 'userLogin')->name('userLogin');
    Route::post('/signup', 'userSignUp')->name('userSignUp');

    Route::get('/logout', 'userLogout')->name('userLogout');
});


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