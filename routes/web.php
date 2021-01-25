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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth');



Auth::routes();

// Route::get('/admin', function(){
//     return view('admin/dashboard');
// })->middleware('auth');
Route::get('/admin/dashboard', 'DashboardController@index');

Route::get('/admin/votes', function(){
    return view('admin/votes');
})->middleware('auth');

Route::get('/admin/voters', function(){
    return view('admin/voters');
})->middleware('auth');
Route::get('/admin/voters/import', 'votersController@getImport')->name('import');
Route::post('/admin/voters/import_parse', 'votersController@parseImport')->name('import_parse');
Route::post('/admin/voters/import_process', 'votersController@processImport')->name('import_process');
Route::get('/admin/positions', function(){
    return view('admin/positions');
})->middleware('auth');

Route::get('/admin/candidates', function(){
    return view('admin/candidates');
})->middleware('auth');
Route::get('/admin/ballot_position', function(){
    return view('admin/ballot_position');
})->middleware('auth');

Route::get('/admin/tally', function(){
    return view('admin/tally');
})->middleware('auth');

// for voters view
Route::get('/', function(){
    // $ok['ok'] = ['ss'=>'ok'];
    // return view('voters/votersballot', $ok);
    return view('voters/votersballot');
});