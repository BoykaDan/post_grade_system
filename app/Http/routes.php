<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*浏览用户视图路由设置*/

Route::get('/', function () {
    return redirect('/article_system');
});

Route::get('article_system', 'article_systemController@index');
Route::get('article_system/grade31419527','article_systemController@showGrade');
Route::get('article_system/{slug}', 'article_systemController@showPost');
Route::get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');
Route::get('sitemap.xml', 'article_systemController@siteMap');
/*后台视图路由设置*/

// Admin area
Route::get('admin', function () {
    return redirect('/admin/post');
});
    Route::group([
        'namespace' => 'Admin','middleware' => 'auth'],
        function () {
    Route::resource('admin/post', 'PostController',['except'=>'show']);
    Route::resource('admin/grade', 'GradeController');
    Route::get('admin/upload', 'UploadController@index');
    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
});

// Logging in and out 
Route::get('/login', 'Auth\AuthController@getLogin');
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
ROute::get('/auth/logout', 'Auth\AuthController@getLogout');
Route::get('/auth/reset','UserController@getReset');
Route::post('/auth/reset','UserController@postReset');

