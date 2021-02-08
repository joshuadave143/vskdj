<?php

use Illuminate\Http\Request;

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
if (App::environment('production')) {
    URL::forceScheme('https');
}
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('election_config', 'adminController@election_config');

Route::get('getconfig', 'adminController@getconfig');

Route::post('countvotes', 'DashboardController@countvotes');

//list of voters
Route::get('voters', 'votersController@index');

// list of voter
Route::get('voter/{id}', 'votersController@show');

// list of search voter
Route::get('voter/{id}', 'votersController@show');

// Create new voter
Route::post('voter', 'votersController@store');

// update voter
Route::put('voter', 'votersController@store');

// Delete voter
Route::delete('voter/{id}', 'votersController@destroy');
// search voter
Route::put('voter/search', 'votersController@search');

// =================== for voters page ==========================
// get detials
Route::get('voter_page/get_voter_info={id}&{passcode}', 'votersController@getDetials');
// preview
Route::post('voter/votesprev', 'votersController@votesprev');

Route::post('voter/submitvotes', 'votersController@submitvotes');

// ===================FOR POSITION==============

//list of positions
Route::get('positions', 'positionsController@index');

// list of position
Route::get('position/{id}', 'positionsController@show');

// Create new position
Route::post('position', 'positionsController@store');

// update position
Route::put('position', 'positionsController@store');

// Delete position
Route::delete('position/{id}', 'positionsController@destroy');

//===================FOR CANDIDATES======================
// LIST OF CANDIDATES
Route::get('candidates', 'candidatesController@index');
// LIST OF CANDIDATE
Route::get('candidate/{id}', 'candidatesController@show');
// CREATE NEW CANDIDATE
Route::post('candidate', 'candidatesController@store');
// UPDATE CANDIDATTE
Route::put('candidate', 'candidatesController@store');
// DELETE CANDIDATTE
Route::delete('candidate/{id}', 'candidatesController@destroy');
// UPLOAD IMAGE
Route::post('upload', 'candidatesController@uploadImage');

//===================FOR BALLOT======================
// FOR BALLOT POSITION
Route::get('ballot/positions', 'ballotController@index');
// UPDATE BALLOT POSITION
Route::put('ballot', 'ballotController@store');
// UPDATE BALLOT POSITION UP
Route::put('moveup', 'ballotController@moveup');
// UPDATE BALLOT POSITION DOWN
Route::put('movedown', 'ballotController@movedown');
// FOR BALLOT POSITION
Route::get('ballot/getCandidates/{id}', 'ballotController@getCandidates');


// ================= DASHBOARD ======================== //

Route::get('get_total_PCVV', 'DashboardController@get_total_PCVV');

Route::get('get_all_data', 'DashboardController@get_all_data');
// ================== FOR VOTES ======================== //
// LIST OF VOTES
Route::get('votes', 'votesController@index');
// Delete all votes
Route::get('deleteAll', 'votesController@deleteAll');





