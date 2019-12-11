<?php

use Illuminate\Http\Request;

use App\Http\Resources\Mood as MoodResource;
use App\Mood;

use App\Http\Resources\Vote as VoteResource;
use App\Vote;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return 'Welcome to the API.';
});

// get all moods
Route::get('/moods', function () {
    return new MoodResource(Mood::all());
});

// get mood by id
Route::get('/moods/{id}', function($id) {
    return new MoodResource(Mood::find($id));
});

// get mood by slug
Route::get('/moods/slug/{slug}', function($slug) {
    return new MoodResource(Mood::where('slug', $slug)->get());
});

Route::get('/votes', function () {
	// TODO: only accessible if authenticated
    return new MoodResource(Vote::all());
});