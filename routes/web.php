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

Route::get('/home', 'TweetsController@index')->name('home');

//tweet関係
Route::group(['prefix'=>'tweets', 'middleware'=>'auth'],function(){
    Route::post('store','tweetsController@store')->name('tweets.store');
    Route::delete('destroy/{id}','tweetsController@destroy')->name('tweets.destroy');
});

//users関係
Route::group(['prefix'=>'users', 'middleware'=>'auth'],function(){
    Route::get('index','UsersController@index')->name('users.index');
    Route::get('show/{id}','UsersController@show')->name('users.show');
});

// follow関係
Route::group(['prefix'=>'users/{id}', 'middleware'=>'auth'],function(){
    Route::post('follow','FollowController@store')->name('follow.follow');
    Route::delete('unfollow','FollowController@destroy')->name('follow.unfollow');
    Route::get('followings','UsersController@followings')->name('users.followings');
    Route::get('followers','UsersController@followers')->name('users.followers');
});

//profile.img関連
Route::group(['middleware'=>'auth'],function(){
    Route::get('profile_index','ProfileController@index')->name('profile.index');
    Route::post('profile_store','ProfileController@store')->name('profile.store');
});


