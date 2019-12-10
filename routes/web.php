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

// homepage
Route::get('/', 'HomeController@index')->name('home');

// votes
Route::get('/votes/new/{voteslug}', ['uses' =>'VoteController@new']);
Route::get('/votes/thank-you', ['uses' =>'VoteController@thank_you']);

// auth routes
Auth::routes();

// statistics
Route::get('/statistics', 'StatisticsController@index')->name('statistics');
Route::get('/statistics/day', 'StatisticsController@day')->name('statistics_day');
Route::get('/statistics/week', 'StatisticsController@week')->name('statistics_week');
Route::get('/statistics/month', 'StatisticsController@month')->name('statistics_month');