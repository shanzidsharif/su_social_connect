<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminModule\app\Http\Controllers\AdminModuleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    /*auth*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit');
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        //assistant
        Route::resource('assistants', 'AssistantController');
        Route::group(['prefix' => 'assistants', 'as' => 'assistants.'], function () {
            Route::put('update-password/{id}', 'AssistantController@update_password')->name('update-password');
            Route::any('data/status-update/{id}', 'AssistantController@status_update')->name('status-update');
            Route::any('data/verification-update/{id}', 'AssistantController@verification_update')->name('verification-update');
        });
        //notice
        Route::resource('notices', 'NoticeController');
        Route::group(['prefix' => 'notices', 'as' => 'notices.'], function () {
            Route::any('data/status-update/{id}', 'NoticeController@status_update')->name('status-update');
        });
        //blog
        Route::resource('blogs', 'BlogController');
        Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
            Route::any('data/status-update/{id}', 'BlogController@status_update')->name('status-update');
            //comment
            Route::prefix('comment')->as('comment.')->group(function () {
                Route::get('get/{blog_id}', 'BlogController@comment_get')->name('get');
                Route::post('store/{blog_id}', 'BlogController@comment_store')->name('store');
                Route::delete('destroy/{comment_id}', 'BlogController@comment_destroy')->name('destroy');
            });
        });
        //message
        Route::get('chat', 'MessageController@index')->name('chat');
        Route::get('message/{id}', 'MessageController@getMessage')->name('message');
        Route::post('message', 'MessageController@sendMessage');
    });
});
