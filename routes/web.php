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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('/admin')->group(function(){
	Route::get("/","AdminController@dashboard")->name("admin.dashboard");
	Route::get("/login","Auth\AdminLoginController@showLoginForm")->name('admin.login.form');
	Route::post("/login","Auth\AdminLoginController@login")->name('admin.login');
	Route::get("/logout","Auth\AdminLoginController@logout")->name('admin.logout');
	Route::post("/logout","Auth\AdminLoginController@logout")->name('admin.logout');
});


Route::get('/home', 'HomeController@index')->name('home');
