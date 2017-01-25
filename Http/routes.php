<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'legacy_client_support', 'middleware' => ['web']], function () {
	//
});



//// Routes in this group must be authorized.
//Route::group(['middleware' => 'authorize'], function () {
//
    // LegacyClientSupport routes
    Route::group(['prefix' => 'legacy_client_support'], function () {
        Route::get('/',        ['as' => 'legacy_client_support.index',         'uses' => 'LegacyClientSupportController@index']);
    }); // End of LegacyClientSupport group
//
//
//}); // end of AUTHORIZE middleware group
