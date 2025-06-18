<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::namespace('App\Http\Controllers\Backend')->prefix("backend")->middleware(['decrypt.parameter'])->group(function () {
    Route::namespace('Admin')->prefix("admin")->group(function () {
        Route::get('/login', 'LoginController@login');
    });
    
    Route::middleware(['auth:backend'])->group(function () {
        //管理员管理
        Route::namespace('Admin')->prefix("admin")->group(function () {
            Route::post('/create', 'AdminController@create')->name("admin.create");
            Route::post('/delete', 'AdminController@delete')->name("admin.delete");
            Route::post('/update', 'AdminController@update')->name("admin.update");
            Route::get('/info', 'AdminController@info');
            Route::get('/search', 'AdminController@search')->name("admin.search");
             Route::get('/logout', 'LogoutController@logout');
        });
    });

});


