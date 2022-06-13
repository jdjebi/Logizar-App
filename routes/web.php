<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;

Route::get('/', function () {

    $projects = Project::orderByDesc("created_at")->get();

    return view('welcome',[
        "projects" => $projects
    ]);


})->name('index');

Route::get('/public/projects/{id}','App\Http\Controllers\ProjectController@showPublic')->name('project.show.public');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {

        return view('dashboard');

    })->name('dashboard');

    Route::get('/projects/new', 'App\Http\Controllers\ProjectController@create')->name('project.create');
    Route::post('/projects/new', 'App\Http\Controllers\ProjectController@store');
    Route::get('/projects/{id}', 'App\Http\Controllers\ProjectController@show')->name('project.show');
    Route::get('/projects/{id}/update', 'App\Http\Controllers\ProjectController@update')->name('project.update');

});