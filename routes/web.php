<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\IndexController')->name('index');

Route::get('/search', 'App\Http\Controllers\Search\SearchController@basic')->name('search.results');
Route::get('/projects/{id}', 'App\Http\Controllers\ProjectController@showById')->where('id', '[0-9]+')->name('project.show.byid');
Route::get('/p/{code_name?}', 'App\Http\Controllers\ProjectController@showByCodeName')->name('project.show.bycodename');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

    Route::get('/projects/new', 'App\Http\Controllers\ProjectController@create')->name('project.create');
    Route::get('/projects/{id}/update', 'App\Http\Controllers\ProjectController@update')->name('project.update');

    Route::middleware(['admin'])->group(function () {

        Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@admin')->name('admin.index');
        Route::get('/admin/projects/categories', 'App\Http\Controllers\Admin\AdminController@adminCategory')->name('admin.project.categories');
        Route::get('/admin/projects/other-categories', 'App\Http\Controllers\Admin\AdminController@adminOtherCategories')->name('admin.project.other-categories');
        Route::get('/admin/projects/types', 'App\Http\Controllers\Admin\AdminController@adminProjectTypes')->name('admin.project.types');
        Route::get('/admin/projects/deliverables', 'App\Http\Controllers\Admin\AdminController@adminProjectDeliverables')->name('admin.project.deliverables');

        Route::get("tests/search", 'App\Http\Controllers\Search\SearchController@test')->name('admin.search.test');
    });
});
