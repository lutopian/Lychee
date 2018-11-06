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

// We need that to force https everywhere
//if (env('APP_ENV') === 'production') {

if (env('APP_ENV') === 'dev') {
    URL::forceScheme('https');
}

Route::get('/', function () { return view('index'); })->name('home');
Route::get('/phpinfo', function () { return (string)phpinfo(); })->name('admin');

Route::post('/php/index.php',               'SessionController@init'); // entry point if options are not initialized
Route::post('/api/Session::init',           'SessionController@init');
Route::post('/api/Session::login',          'SessionController@login');
Route::post('/api/Session::logout',         'SessionController@logout');

Route::post('/api/Albums::get',             'AlbumsController@get');

Route::post('/api/Album::get',              'AlbumController@get')->middleware('AlbumPWCheck');
Route::post('/api/Album::getPublic',        'AlbumController@getPublic');
Route::post('/api/Album::add',              'AlbumController@add')->middleware('upload');
Route::post('/api/Album::setTitle',         'AlbumController@setTitle')->middleware('upload');
Route::post('/api/Album::setDescription',   'AlbumController@setDescription')->middleware('upload');
Route::post('/api/Album::setPublic',        'AlbumController@setPublic')->middleware('upload');
Route::post('/api/Album::delete',           'AlbumController@delete')->middleware('upload');
Route::post('/api/Album::merge',            'AlbumController@merge')->middleware('upload');

Route::post('/api/Photo::get',              'PhotoController@get')->middleware('AlbumPWCheck');
Route::post('/api/Photo::setTitle',         'PhotoController@setTitle')->middleware('upload');
Route::post('/api/Photo::setDescription',   'PhotoController@setDescription')->middleware('upload');
Route::post('/api/Photo::setStar',          'PhotoController@setStar')->middleware('upload');
Route::post('/api/Photo::setPublic',        'PhotoController@setPublic')->middleware('upload');
Route::post('/api/Photo::setAlbum',         'PhotoController@setAlbum')->middleware('upload');
Route::post('/api/Photo::setTags',          'PhotoController@setTags')->middleware('upload');
Route::post('/api/Photo::add',              'PhotoController@add')->middleware('upload');
Route::post('/api/Photo::delete',           'PhotoController@delete')->middleware('upload');
Route::post('/api/Photo::duplicate',        'PhotoController@duplicate')->middleware('upload');

Route::post('/api/Sharing::List',           'SharingController@list_sharing')->middleware('upload');
Route::post('/api/Sharing::Add',            'SharingController@add')->middleware('upload');
Route::post('/api/Sharing::Delete',         'SharingController@delete')->middleware('upload');

Route::post('/api/Settings::setLogin',      'SettingsController@setLogin');
Route::post('/api/Settings::setSorting',    'SettingsController@setSorting')->middleware('admin');
Route::post('/api/Settings::setLang',       'SettingsController@setLang')->middleware('admin');

Route::post('/api/User::List',              'UserController@list')->middleware('admin');
Route::post('/api/User::Save',              'UserController@save')->middleware('admin');
Route::post('/api/User::Delete',            'UserController@delete')->middleware('admin');
Route::post('/api/User::Create',            'UserController@create')->middleware('admin');

Route::post('/api/Logs',                    'LogController@display')->middleware('admin');
Route::post('/api/Diagnostics',             'DiagnosticsController@show')->middleware('admin');

// unused
Route::post('/api/Logs::clear',               'LogController@clear')->middleware('admin');

Route::post('/api/search', function () { return 'false'; });
