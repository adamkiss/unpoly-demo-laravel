<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return view('home');
})->name('home');

Route::resource('companies', CompanyController::class);

Route::resource('projects', ProjectController::class);
Route::get('utils/suggest-project-name', [ProjectController::class, 'suggestName'])->name('projects.suggest-name');

Route::resource('tasks', TaskController::class);
