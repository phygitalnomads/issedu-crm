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
    return redirect('admin/login');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/crm','MiniCrmController@crm');
Route::get('/testcrm','MiniCrmController@testcrm');
//Route::get('/crmprofs','MiniCrmController@crmprofs');

Route::get('/admin/utilizator','CrmStudentController@index');

//Route::get('/admin/profesor','CrmProfessorController@index');

