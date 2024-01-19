<?php

use Illuminate\Support\Facades\Route;
use Modules\TeacherModule\app\Http\Controllers\TeacherModuleController;

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

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('teachers', 'TeacherController');
    Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
        Route::any('data/status-update/{id}', 'TeacherController@status_update')->name('status-update');
        Route::any('data/verification-update/{id}', 'TeacherController@verification_update')->name('verification-update');
    });
});
//teacher
Route::group(['namespace' => 'Teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function () {
    /*auth*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit')->name('login');
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('forgot-password-email', 'LoginController@forgot_email_form')->name('forgot-password-email');
        Route::post('forgot-password-email', 'LoginController@forgot_email_submit')->name('forgot-password-email');
        Route::get('forgot-password-otp', 'LoginController@forgot_otp_form')->name('forgot-password-otp');
        Route::post('forgot-password-otp', 'LoginController@forgot_otp_submit')->name('forgot-password-otp');
        Route::get('password-reset', 'LoginController@password_reset')->name('password-reset');
        Route::post('password-reset', 'LoginController@password_reset_submit')->name('password-reset');
        Route::get('registration', 'RegistrationController@registration')->name('registration');
        Route::post('registration', 'RegistrationController@submit')->name('registration');

    });

    Route::group(['middleware' => 'teacher'], function () {
        //dashboard
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');
        //follow request
        Route::group(['prefix' => 'follow-request', 'as' => 'follow-request.'], function() {
            Route::get('get', 'FollowRequestController@get')->name('get');
            Route::get('accept/{id}', 'FollowRequestController@accept')->name('accept');
            Route::delete('destroy/{id}', 'FollowRequestController@destroy')->name('destroy');
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
        //profile
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('get', 'ProfileController@get')->name('get');
            Route::post('update', 'ProfileController@update')->name('update');
            Route::post('update-password', 'ProfileController@update_password')->name('update-password');
        });
    });
});
