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
Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'permissions', 'middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'permissions',
        'middleware' => ['permission:permission-list|permission-create|permission-edit|permission-delete'],
        'uses' => 'PermissionController@index']);
    Route::get('/create', ['as' => 'permissions.create',
        'middleware' => ['permission:permission-create'],
        'uses' => 'PermissionController@create']);
    Route::post('/store', ['as' => 'permissions.store',
        'middleware' => ['permission:permission-create'],
        'uses' => 'PermissionController@store']);
    Route::get('/edit/{id}', ['as' => 'permissions.edit',
        'middleware' => ['permission:permission-edit'],
        'uses' => 'PermissionController@edit']);
    Route::delete('/{id}', ['as' => 'permissions.destroy',
        'middleware' => ['permission:permission-delete'],
        'uses' => 'PermissionController@destroy']);
    Route::patch('/{id}', ['as' => 'permissions.update',
        'middleware' => ['permission:permission-edit'],
        'uses' => 'PermissionController@update']);
});
//permissions
//roles
Route::group(['prefix' => 'roles', 'middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'roles',
        'middleware' => ['permission:role-list|role-create|role-edit|role-delete'],
        'uses' => 'RoleController@index']);
    Route::get('/create', ['as' => 'roles.create',
        'middleware' => ['permission:role-create'],
        'uses' => 'RoleController@create']);
    Route::post('/store', ['as' => 'roles.store',
        'middleware' => ['permission:role-create'],
        'uses' => 'RoleController@store']);
    Route::get('/edit/{id}', ['as' => 'roles.edit',
        'middleware' => ['permission:role-edit'],
        'uses' => 'RoleController@edit']);
    Route::delete('/{id}', ['as' => 'roles.destroy',
        'middleware' => ['permission:role-delete'],
        'uses' => 'RoleController@destroy']);
    Route::patch('/{id}', ['as' => 'roles.update',
        'middleware' => ['permission:role-edit'], 'uses' => 'RoleController@update']);
    Route::get('/role-permission-table', ['as' => 'roles.table',
        'middleware' => ['permission:role-list'],
        'uses' => 'RoleController@table']);
    Route::post('/role-permission-table', ['as' => 'roles.table.update',
        'middleware' => ['permission:role-edit'],
        'uses' => 'RoleController@tableUpdate']);
});
//roles
//users
Route::group(['prefix' => 'users', 'middleware' => ['auth']], function () {
    Route::get('/', ['as' => 'users',
        'middleware' => ['permission:user-list'],
        'uses' => 'UserController@index']);
    Route::get('/data', ['as' => 'users.data',
        'middleware' => ['permission:user-list'],
        'uses' => 'UserController@indexData']);
    Route::get('/edit/{id}', ['as' => 'users.edit',
        'middleware' => ['permission:user-edit'],
        'uses' => 'UserController@edit']);
    Route::delete('/{id}', ['as' => 'users.destroy',
        'middleware' => ['permission:user-delete'],
        'uses' => 'UserController@destroy']);
    Route::patch('/{id}', ['as' => 'users.update',
        'middleware' => ['permission:user-edit'], 'uses' => 'UserController@update']);
    Route::get('/user-role-table', ['as' => 'users.table',
        'middleware' => ['permission:user-edit'],
        'uses' => 'UserController@table']);
    Route::post('/user-role-table', ['as' => 'users.roles.update',
        'middleware' => ['permission:user-edit'],
        'uses' => 'UserController@tableUpdate']);
});
