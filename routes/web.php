<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Logizar\Search\SearchEngine;

Route::get('/', function () {

    $projects = Project::orderByDesc("created_at")->get();

    return view('welcome', [
        "projects" => $projects
    ]);

})->name('index');


Route::get('/search','App\Http\Controllers\Search\SearchController@basic')->name('search.results');
Route::get('/public/projects/{id}', 'App\Http\Controllers\ProjectController@showPublic')->name('project.show.public');
Route::get('/p/{code_name?}', 'App\Http\Controllers\ProjectController@showByCodeName')->name('project.show.bycodename');

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

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@adminCategory')->name('admin.index');
        Route::get('/admin/projects/categories', 'App\Http\Controllers\Admin\AdminController@adminCategory')->name('admin.project.categories');
        Route::get('/admin/projects/other-categories', 'App\Http\Controllers\Admin\AdminController@adminOtherCategories')->name('admin.project.other-categories');
        Route::get('/admin/projects/types', 'App\Http\Controllers\Admin\AdminController@adminProjectTypes')->name('admin.project.types');
        Route::get('/admin/projects/deliverables','App\Http\Controllers\Admin\AdminController@adminProjectDeliverables')->name('admin.project.deliverables');
    });
});

Route::get("tests/search", function (Request $request) {
    $searchContent = $request->q;
    if(!empty($searchContent)){
        $searchEngine = new SearchEngine();  
        $results = $searchEngine->searchWithLikeAndOrderByFulltext($searchContent);
    }
    return $results;
});
