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

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
//views
Route::get('/home', 'HomeController@index');
Route::get('/create', 'HomeController@createView');
Route::get('/list', 'HomeController@quizList');
Route::get('/quiz/{id}', 'HomeController@getQuiz');
//crud
Route::post('/create', 'HomeController@createQuiz');
Route::get('/remove-quiz/{id}', 'HomeController@removeQuiz');
