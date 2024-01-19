<?php

use Illuminate\Support\Facades\Route;
use Modules\FrontendModule\app\Http\Controllers\FrontendModuleController;
use Modules\FrontendModule\app\Http\Controllers\HomeController;

Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('all-notices', [HomeController::class, 'all_notices'])->name('all-notices');
    Route::get('blog-details/{id}', [HomeController::class, 'blog_details'])->name('blog-details');
    Route::post('blog-comment/{id}', [HomeController::class, 'blog_comment'])->name('blog-comment');
});