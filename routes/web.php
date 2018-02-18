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

Route::group(['middleware' => ['auth']], function () {
    Route::get('backend', ['as' => 'backend', 'uses' => 'Backend\UsersController@index']);

    Route::group(['middleware' => ['permission:backend categories']], function () {
        Route::resource('backend/categories', 'Backend\CategoriesController', ['as' => 'backend']);
        Route::get('backend/categories/{id}/delete', ['as' => 'backend.categories.delete', 'uses' => 'Backend\CategoriesController@delete']);
    });
    Route::group(['middleware' => ['permission:backend media']], function () {
        Route::resource('backend/media', 'Backend\MediaController', ['as' => 'backend']);
        Route::get('backend/media/{id}/delete', ['as' => 'backend.media.delete', 'uses' => 'Backend\MediaController@delete']);
        Route::get('backend/media/{id}/trash', ['as' => 'backend.media.trash', 'uses' => 'Backend\MediaController@trash']);
        Route::post('backend/media/upload', ['as' => 'backend.media.upload', 'uses' => 'Backend\MediaController@upload']);
    });
    Route::group(['middleware' => ['permission:backend medium categories']], function () {
        Route::resource('backend/medium-categories', 'Backend\MediumCategoriesController', ['as' => 'backend']);
        Route::get('backend/medium-categories/{id}/delete', ['as' => 'backend.medium-categories.delete', 'uses' => 'Backend\MediumCategoriesController@delete']);
    });
    Route::group(['middleware' => ['permission:backend menus']], function () {
        Route::resource('backend/menus', 'Backend\MenusController', ['as' => 'backend']);
        Route::get('backend/menus/{id}/delete', ['as' => 'backend.menus.delete', 'uses' => 'Backend\MenusController@delete']);
    });
    Route::group(['middleware' => ['permission:backend options']], function () {
        Route::resource('backend/options', 'Backend\OptionsController', ['as' => 'backend']);
        Route::get('backend/options/{id}/delete', ['as' => 'backend.options.delete', 'uses' => 'Backend\OptionsController@delete']);
    });
    Route::group(['middleware' => ['permission:backend permissions']], function () {
        Route::resource('backend/permissions', 'Backend\PermissionsController', ['as' => 'backend']);
        Route::get('backend/permissions/{id}/delete', ['as' => 'backend.permissions.delete', 'uses' => 'Backend\PermissionsController@delete']);
    });
    Route::group(['middleware' => ['permission:backend posts']], function () {
        Route::resource('backend/posts', 'Backend\PostsController', ['as' => 'backend']);
        Route::get('backend/posts/{id}/delete', ['as' => 'backend.posts.delete', 'uses' => 'Backend\PostsController@delete']);
        Route::get('backend/posts/{id}/trash', ['as' => 'backend.posts.trash', 'uses' => 'Backend\PostsController@trash']);
    });
    Route::group(['middleware' => ['permission:backend roles']], function () {
        Route::resource('backend/roles', 'Backend\RolesController', ['as' => 'backend']);
        Route::get('backend/roles/{id}/delete', ['as' => 'backend.roles.delete', 'uses' => 'Backend\RolesController@delete']);
    });
    Route::group(['middleware' => ['permission:backend tags']], function () {
        Route::resource('backend/tags', 'Backend\TagsController', ['as' => 'backend']);
        Route::get('backend/tags/{id}/delete', ['as' => 'backend.tags.delete', 'uses' => 'Backend\TagsController@delete']);
    });
    Route::group(['middleware' => ['permission:backend users']], function () {
        Route::resource('backend/users', 'Backend\UsersController', ['as' => 'backend']);
        Route::get('backend/users/{id}/delete', ['as' => 'backend.users.delete', 'uses' => 'Backend\UsersController@delete']);
    });
});
// Route::get('/backend', 'Backend\HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('locale/{locale?}', ['as' => 'locale.setlocale', 'uses' => 'Frontend\LocaleController@setLocale']);
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|github|google');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|github|google');
Route::get('/', function () {
    return view('welcome');
});
