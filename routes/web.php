<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

Auth::routes();

Route::post('admin-register', 'Auth\RegisterController@adminRegister');
Route::get('/', function () {
    if (!User::adminExists()) {
        return (new AdminController())->show();
    }

    return view('/home');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@show');

Route::get('/projects', function () {
    $projects = Project::where('status', 'published')->get();
    return view('projects', ['projects' => $projects]);
});

Route::get('/project/{project:slug}', 'ProjectController@show');
