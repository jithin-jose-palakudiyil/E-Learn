<?php

/*
|--------------------------------------------------------------------------
| Constants variables
|--------------------------------------------------------------------------
|
| Here is where you can register Constants variables for your application. These
| variables are loaded by the application. Now create something great!
|
*/

define("admin_prefix", "bh_elearn");
define("admin_guard", "admin");
define("project_name", "Bharat Elearn");




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
 
Route::group([ 'middleware' => 'preventBackHistory','prefix' => admin_prefix ], function()
{
    Route::get('/', 'AuthController@index')->name('admin_user_login');
    Route::any('/login', 'AuthController@LoginAction');
    
    /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:'.admin_guard], function()
    {
        Route::get('/logout', 'AuthController@logout')->name('admin_logout');
        Route::get('/dashboard', 'DashboardController@index');
        
        /*
        |--------------------------------------------------------------------------
        | Question Category Resource Route
        |-------------------------------------------------------------------------- 
        */
        Route::get('/question-category-list', 'QuestionCategoryController@list_dataTable')->name('question_category_list');
        Route::bind('question-category', function ($value, $route) {return Modules\BackEnd\Entities\QuestionCategory::find($value); }); 
        Route::resource( '/question-category', 'QuestionCategoryController',
                        [ 
                            'names' => [
                                        'index'   => 'question-category',
                                        'create'  => 'question-category.create', 
                                        'store'   => 'question-category.store', 
                                        'edit'    => 'question-category.edit',
                                        'update'  => 'question-category.update',
                                        'destroy' => 'question-category.destroy' 
                                       ],
                        ]
        );  
        
        
        /*
        |--------------------------------------------------------------------------
        | Questions Resource Route
        |-------------------------------------------------------------------------- 
        */
        Route::get('/questions-list', 'QuestionsController@list_dataTable')->name('questions_list');
        Route::bind('questions', function ($value, $route) {return Modules\BackEnd\Entities\Questions::find($value); }); 
        Route::resource( 'questions', 'QuestionsController',
                        [ 
                            'names' => [
                                        'index'   => 'questions',
                                        'create'  => 'questions.create', 
                                        'store'   => 'questions.store', 
                                        'edit'    => 'questions.edit',
                                        'update'  => 'questions.update',
                                        'destroy' => 'questions.destroy' 
                                       ],
                        ]
        ); 
        
        
        
        
        
        /*
        |--------------------------------------------------------------------------
        | Question Category Resource Route
        |-------------------------------------------------------------------------- 
        */
        Route::get('/packages/publish/{package}', 'PackageController@publish_package');
        
        Route::get('/packages-list', 'PackageController@list_dataTable')->name('packages_list');
        
        Route::bind('packages', function ($value, $route) {return Modules\BackEnd\Entities\Packages::find($value); }); 
        Route::resource( '/packages', 'PackageController',
                        [ 
                            'names' => [
                                        'index'   => 'packages',
                                        'create'  => 'packages.create', 
                                        'store'   => 'packages.store', 
                                        'edit'    => 'packages.edit',
                                        'update'  => 'packages.update',
                                        'destroy' => 'packages.destroy' 
                                       ],
                        ]
        );    
        
        /*
        |--------------------------------------------------------------------------
        | Bundle and Assign Question Route
        |-------------------------------------------------------------------------- 
        */
        
        Route::get('/packages/sets/{package_id}', 'SetsController@index')->name('sets_list');
        Route::get('/packages/sets/{package}/{set}', 'SetsController@assign_question_index')->name('assign_question_index');
        Route::post('/packages/sets-store-questions/{package}/{set}', 'SetsController@store')->name('store_sets_question');
        
        
    });
 
});
