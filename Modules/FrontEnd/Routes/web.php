<?php

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


define("_prefix", "/");
define("user_guard", "front_user");
 
Route::group(['prefix' => _prefix ], function()
{
    Route::get('/', 'HomeController@index');
    Route::get('/example', 'HomeController@example'); // api
    Route::get('/test_exam', 'HomeController@test_exam'); //view
    Route::get('/test_exam_trial', 'HomeController@test_exam_trials'); //view
    /*
    |--------------------------------------------------------------------------
    | Login To Account Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/login', 'AuthController@index')->name('front_user_login');
    Route::post('/login-check', 'AuthController@store')->name('front_user_login_action');
    Route::get('/logout', 'AuthController@logout')->name('front_user_logout');
    
    /*
    |--------------------------------------------------------------------------
    | Register Account  Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/register', 'RegisterController@index');
    Route::post('/save-account', 'RegisterController@store')->name('save_front_user_account');
    Route::get('/ValidateMobile', 'RegisterController@ValidateMobile');
    Route::get('/ValidateEmail', 'RegisterController@ValidateEmail');
    
    
    /* logged user opertaions */
    Route::group(['middleware' =>  ['preventBackHistory','user_auth:'.user_guard]], function()
    { 
        Route::get('/register/otp', 'RegisterController@register_otp')->name('register_otp');
        Route::get('/otp-resend', 'RegisterController@otp_resend')->name('otp_resend');
        Route::post('/save-otp', 'RegisterController@otp_verification')->name('otp_verification');
        Route::get('/dashboard', 'DashboardController@index')->name('user_dashboard');
        Route::get('/profile', 'ProfileController@index')->name('user_profile');
        Route::get('/settings', 'SettingsController@index')->name('user_settings');
        Route::post('/save-settings', 'SettingsController@save_settings')->name('save_settings');
        Route::post('/change-settings-password', 'SettingsController@change_settings_password')->name('change_settings_password');
        
        
    });  

    Route::get('/package-purchase/{package_id}', 'PurchaseController@index')->name('package_purchase');
    
    
});
