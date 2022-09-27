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

Auth::routes();

Route::get('/', function () {
    return redirect()->route("dashboard");
});

//Route::get('/home', 'HomeController@index')->name('home');

/// User and Admin routes start ///
Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('settings/{page?}', 'SettingController@settings')->name('settings');
    Route::post('/layout-page', 'SettingController@layoutPage')->name('layout_page');
    Route::post('/profile/update', 'UserController@updateUpdate')->name('user.update');
    Route::post('/password/upadte', 'UserController@passwordUpadte')->name('user.password.update');
    Route::post('/complain/text/store', 'ComplainController@textStore')->name('complain.text.store');
    Route::post('/complain/file/store', 'ComplainController@fileStore')->name('complain.file.store');
    Route::post('/complain/get-msg', 'ComplainController@getSingleMessage')->name('complain.get.single-message');
    Route::post('/complain/get-prev-msg', 'ComplainController@getPreviousMessage')->name('complain.get.prev-message');

});
/// User and Admin end ///

/// User routes start ///
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/complain', 'ComplainController@userIndex')->name('user.complain');
});
/// User routes end ///


/// Admin routes start ///
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/complains', 'ComplainController@adminIndex')->name('admin.complain');
    Route::get('/complains/user/{user_id}', 'ComplainController@individualMsg')->name('admin.individual.msg');

    // Route::prefix('group')->group(function () {
    //     Route::get('/', 'GroupController@index')->name('group.all');
    //     Route::get('/create', 'GroupController@create')->name('group.create');
    //     Route::post('/store', 'GroupController@store')->name('group.store');
    //     Route::get('/edit/{id}', 'GroupController@edit')->name('group.edit');
    //     Route::post('/update/{id}', 'GroupController@update')->name('group.update');
    //     Route::get('/delete/{id}', 'GroupController@destroy')->name('group.destroy');
    // });
    Route::resource('group','GroupController')->parameters(['group' => 'id']);
    Route::resource('admin/group','AdminGroupController',  ['as' => 'admin'])->parameters(['group' => 'id']);
    Route::resource('region','RegionController')->parameters(['region' => 'id']);
    Route::resource('team','TeamController')->parameters(['team' => 'id']);
});
/// Admin routes end ///