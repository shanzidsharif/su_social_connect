<?php

use Illuminate\Support\Facades\Route;
use Modules\StudentModule\app\Http\Controllers\StudentModuleController;

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
//admin
Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('students', 'StudentController');
    Route::group(['prefix' => 'students', 'as' => 'students.'], function () {
        Route::any('data/status-update/{id}', 'StudentController@status_update')->name('status-update');
        Route::any('data/verification-update/{id}', 'StudentController@verification_update')->name('verification-update');
    });
});
//student
Route::group(['namespace' => 'Student', 'prefix' => 'student', 'as' => 'student.'], function () {
    /*auth*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit')->name('login-submit');
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
    //student middleware
    Route::group(['middleware' => 'student'], function () {
        Route::get('teachers-list', 'FrontendController@teachers_list')->name('teachers-list');
        Route::get('send-follow-request/{teacher_user_id}', 'FrontendController@send_follow_request')->name('send-follow-request');
        Route::get('delete-follow-request/{teacher_user_id}', 'FrontendController@delete_follow_request')->name('delete-follow-request');
        //message
        Route::get('chat', 'MessageController@index')->name('chat');
        Route::get('message/{id}', 'MessageController@getMessage')->name('message');
        Route::post('message', 'MessageController@sendMessage')->name('post-message');
        //profile
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('get', 'ProfileController@get')->name('get');
            Route::post('update', 'ProfileController@update')->name('update');
            Route::post('update-password', 'ProfileController@update_password')->name('update-password');
        });
    });
});
