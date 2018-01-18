<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('actions','ActionController');
Route::resource('answers','AnswerController');
Route::resource('petitions','PetitionController');
Route::get('petitions/current/{user}','PetitionController@currentPetition');
Route::resource('questions','QuestionController');
Route::resource('results','ResultController');
Route::resource('users','UserController');