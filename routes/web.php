<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/work/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store')
    ->middleware('throttle:5,1');
