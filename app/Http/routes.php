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
    return Redirect::to('login');
});

Route::auth();
//admin views
Route::get('home', 'HomeController@index');
Route::get('create', 'HomeController@createView');
Route::get('list', 'HomeController@quizList');
Route::get('quiz/{id}', 'HomeController@getQuiz');
//admin crud
Route::post('/create', 'HomeController@createQuiz');
Route::post('/update/{id}', 'HomeController@updateQuiz');
Route::get('remove-quiz/{id}', 'HomeController@removeQuiz');
Route::get('quiz/api/{id}', 'HomeController@ajaxGetQuiz');
//front views
Route::get('quiz/single/{unique_id}', 'FrontController@getSingleQuiz');
Route::get('quiz/multi/{unique_id}', 'FrontController@getMultiQuiz');
Route::get('quiz/poll/{unique_id}', 'FrontController@getPollQuiz');
//front crud
Route::post('quiz/result/{id}/{ans_id}', 'FrontController@result');
//front ajax
Route::get('quiz/get/{unique_id}', 'FrontController@getQuiz');
Route::post('quiz/update-counter', 'FrontController@updateCounter');
