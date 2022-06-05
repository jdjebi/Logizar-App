<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;

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

Route::get('/', function () {

    $projects = Project::orderByDesc("created_at")->get();

    return view('welcome',[
        "projects" => $projects
    ]);


})->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {

        return view('dashboard');

    })->name('dashboard');

    Route::get('/project/new', 'App\Http\Controllers\ProjectController@create')->name('project.create');
    Route::post('/project/new', 'App\Http\Controllers\ProjectController@store');

});