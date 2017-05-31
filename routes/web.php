<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your Module. Just tell Your app the URIs it should respond to
| using a Closure or controller method. Build something great!
|
*/

use Illuminate\Routing\Router;

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function (Router $router) {
    $router->group(['prefix' => 'navs'], function (Router $router) {
        $router->get('', 'NavController@index')->name('navs.index')->middleware('has-permission:view-navs');

        $router->post('', 'NavController@index')->name('navs.index')->middleware('has-permission:view-navs');

        $router->get('create', 'NavController@create')->name('navs.create')->middleware('has-permission:create-navs');

        $router->post('create', 'NavController@store')->name('navs.store')->middleware('has-permission:create-navs');

        $router->get('edit/{id}', 'NavController@edit')->name('navs.edit')->middleware('has-permission:edit-navs');

        $router->post('edit/{id}', 'NavController@update')->name('navs.update')->middleware('has-permission:edit-navs');

        $router->delete('{id}', 'NavController@destroy')->name('navs.destroy')->middleware('has-permission:delete-navs');
    });
});