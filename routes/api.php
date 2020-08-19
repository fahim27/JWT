<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/////Start The Admin Route Group
Route::group([
     'middleware'=>['assign.guard:users','jwt.auth'],
    'namespace' => 'Api',
  //  'prefix' => 'api'
],
    function () {

        Route::get('/index', 'StudentController@index')->name('student');

    
    });


    Route::group([

      //  'middleware' => 'api',
        'namespace' => 'Api',
        'prefix' => 'auth'
    
    ], function ($router) {
    
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    
    });