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


Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('create', 'DisplayDataController@create');
Route::get('index1', 'DisplayDataController@data');
Route::get('index', 'DisplayDataController@index');



//Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login')->name('login.submit');
    Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminAuth\RegisterController@register')->name('registration.submit');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');



    Route::group(['middleware' => ['admin']],function (){
        Route::get('home', 'AdminController@index')->name('admin.home');
        Route::get('user/create', 'AdminController@create')->name('admin.create');
        Route::post('user/create', 'AdminController@adminCreate')->name('admin.create.submit');
        Route::get('user/list', 'AdminController@adminList')->name('admin.list');

        Route::get('user/edit/{id}', 'AdminController@adminEdit')->name('admin.edit');
        Route::put('user/edit/{id}', 'AdminController@adminUpdate')->name('admin.update');


        Route::get('user/view/{id}', 'AdminController@adminView')->name('admin.view');

        Route::get('user/disable/{id}', 'AdminController@adminDisable')->name('admin.disable');
        Route::post('user/disable', 'AdminController@adminMultiDisable')->name('admin.multidisable');


        Route::get('user/enable/{id}', 'AdminController@adminEnable')->name('admin.enable');
        Route::post('user/enable', 'AdminController@adminMultiEnable')->name('admin.multienable');


        Route::get('user/delete/{id}', 'AdminController@adminDelete')->name('admin.delete');
        Route::post('user/delete', 'AdminController@adminMultiDelete')->name('admin.multidelete');

        Route::get('user/dataList', 'AdminController@adminDataListApi')->name('admin.datalist');

        //Term

        Route::get('term/dataList/{status?}', 'Term\TermController@termDataListApi')->name('term.datalist');
        Route::get('term/trash', 'Term\TermController@trash')->name('term.trash');

        Route::post('term/deletemultiple', 'Term\TermController@destroyMultiple')->name('term.deletemultiple');
        Route::post('term/trashmultiple', 'Term\TermController@trashMultiple')->name('term.trashmultiple');
        Route::post('term/recovermultiple', 'Term\TermController@recoverMultiple')->name('term.recovermultiple');

        Route::resource('term','Term\TermController');

        //Term

        //Post

        Route::get('post/dataList/{status?}', 'Post\PostController@postDataListApi')->name('post.datalist');
        Route::get('post/trash', 'Post\PostController@trash')->name('post.trash');

        Route::post('post/deletemultiple', 'Post\PostController@destroyMultiple')->name('post.deletemultiple');
        Route::post('post/trashmultiple', 'Post\PostController@trashMultiple')->name('post.trashmultiple');
        Route::post('post/recovermultiple', 'Post\PostController@recoverMultiple')->name('post.recovermultiple');

        Route::resource('post','Post\PostController');

        //Post
    });
});
