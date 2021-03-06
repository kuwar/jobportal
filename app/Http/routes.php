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

Route::get('/home', 'HomeController@index');

#Job resource controller
Route::get('/job/{job}/delete', 'JobController@deleteJob');
Route::post('/job/delete-skill', 'JobController@deleteSkill');
Route::post('/job/add-skills', 'JobController@addSkills');
Route::post('/job/verify-job-link-id', 'JobController@verifyJobLinkId');
Route::resource('/job', 'JobController');
