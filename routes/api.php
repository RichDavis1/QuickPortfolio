<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes([]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/contact/create', 'ContactController@create');
Route::post('/contact/store', 'ContactController@store');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('project/create', 'ProjectController@create');
    Route::post('project/store', 'ProjectController@store');
    Route::post('/project/{project}/update', 'ProjectController@update');
    Route::get('/project/{project}/edit', 'ProjectController@edit');
    Route::get('/project/{project}/delete', 'ProjectController@delete');
    Route::post('/project/{project}/destroy', 'ProjectController@destroy');

    Route::get('/category/create/', 'CategoryController@create');
    Route::post('/category/store/', 'CategoryController@store');
    Route::post('/category/{category}/destroy', 'CategoryController@destroy');

    Route::post('/adminsettings/update', 'AdminSettingsController@update');

    Route::get('/admin/projects/get', 'AdminController@createPostsContainer');
    Route::get('/admin/settings/get', 'AdminController@settingsContainer');
    Route::get('/admin/create/get', 'AdminController@createContainer');
    Route::get('/admin/contacts/get', 'AdminController@contactContainer');
});
