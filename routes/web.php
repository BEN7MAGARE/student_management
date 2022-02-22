<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('courses',CourseController::class);
Route::post('course/update', [CourseController::class, 'update'])->name('course.update');
Route::get('courses-get', [CourseController::class, 'get']);

Route::resource('classes', ClassesController::class);
Route::post('classes/update', [ClassesController::class, 'update'])->name('class.update');

Route::resource('applications', ApplicationController::class);
Route::get('applications/select', [ApplicationController::class, 'select'])->name("application.select");