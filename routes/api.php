<?php

use Illuminate\Http\Request;

use App\Http\Resources\MoodResource;
use App\Mood;
use App\Http\Controllers\StatisticsController;
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

Route::get('/statistics/day', function () {
	$statistics = new StatisticsController();
	return $statistics->api_day();
})->middleware('auth:api');


Route::get('/statistics/week', function () {
	$statistics = new StatisticsController();
	return $statistics->api_week();
})->middleware('auth:api');

Route::get('/statistics/month', function () {
	$statistics = new StatisticsController();
	return $statistics->api_month();
})->middleware('auth:api');

Route::post('/votes/new', function(Request $request) {
	$mood_id = isset($request->mood_id) ? $request->mood_id : false;

	if (! $mood_id) {
		return ["message" => "Invalid request."];
	}


    $vote = new Vote;
    $vote->mood_id = $mood_id;
    $vote->datetime = date("Y-m-d H:i:s");
    $vote->save();

	return $vote;
});




