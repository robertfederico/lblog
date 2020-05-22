<?php

use App\Category;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index')->name('main');

Route::post('subscriber', 'SubscriberController@store');

Route::get('posts', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');

Route::get('category/{slug}', 'PostController@postByCategory')->name('category.post');
Route::get('tags/{slug}', 'PostController@postByTag')->name('tag.post');

Route::get('search', 'SearchController@search')->name('search');

Route::get('profile/{username}', 'AuthorController@profile')->name('author.profile');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
    Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
});


Route::group(
    ['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('tag', 'TagController');
        Route::resource('category', 'CategoryController');
        Route::resource('post', 'PostController');
        Route::get('pending/post', 'PostController@pending')->name('post.pending');
        Route::put('post/{id}/approve', 'PostController@approval')->name('post.approve');

        Route::get('subscriber', 'SubscriberController@index')->name('subscriber.index');
        Route::delete('subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile/update', 'SettingsController@update')->name('profile.update');
        Route::put('password/update', 'SettingsController@updatePassword')->name('password.update');

        Route::get('favorite', 'FavoriteController@index')->name('favorite.index');

        Route::get('comments', 'CommentController@index')->name('comment.index');
        Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');

        Route::get('author', 'AuthorController@index')->name('author.index');
        Route::delete('author/{id}', 'AuthorController@destroy')->name('author.destroy');
    }
);

Route::group(
    ['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']],
    function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('post', 'PostController');

        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('profile/update', 'SettingsController@update')->name('profile.update');
        Route::put('password/update', 'SettingsController@updatePassword')->name('password.update');

        Route::get('favorite', 'FavoriteController@index')->name('favorite.index');

        Route::get('comments', 'CommentController@index')->name('comment.index');
        Route::delete('comment/{id}', 'CommentController@destroy')->name('comment.destroy');
    }
);

View::composer('layouts.frontend.partial.footer', function ($view) {
    $categories = Category::all();
    $view->with('categories', $categories);
});